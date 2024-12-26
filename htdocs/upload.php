<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php


// Define the parent directory for user projects
$baseDir = __DIR__."/../site/";
$uploadFile = $baseDir . basename($_FILES['file']['name']);

// Function to check if file is uploaded
function isFileUploaded($file) {
    return isset($file) && $file['error'] === UPLOAD_ERR_OK;
}

// Function to check if folder is uploaded
function isFolderUploaded($folder) {
    return isset($folder['name']) && !empty($folder['name'][0]);
}

// Function to handle file upload
function handleFileUpload($uploadFile) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        echo "<br> File is valid and was successfully uploaded.\n<br>";
    } else {
        echo "Possible file upload attack!\n<br>";
    }
}

// Function to extract ZIP file and get the name of the extracted file if only one file is extracted
function extractZipFile($uploadFile, $uploadDir, $newDirName) {
    $zip = new ZipArchive;
    $exfile = "";
    if ($zip->open($uploadFile) === TRUE) {
        $zip->extractTo($uploadDir);
        $extractedFiles = [];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $extractedFiles[] = $zip->getNameIndex($i);
        }

        if (count($extractedFiles) === 1) {
            $exfile = $extractedFiles[0];
            echo "Only one file extracted: $exfile\n<br>";
        }

        $zip->close();
        echo "ZIP extracted successfully!\n<br>";

        $dirToRename = str_replace(".zip", "", $uploadFile);
        renameDirectory($dirToRename, $newDirName);
        deleteZipFile($uploadFile);
    } else {
        echo "Failed to open ZIP file.\n<br>";
    }

    return $exfile;
}

// Function to rename directory
function renameDirectory($dirToRename, $newDirName) {
    if (rename($dirToRename, $newDirName)) {
        echo "Directory renamed to: $newDirName\n<br>";
    } else {
        echo "Failed to rename the directory.\n<br>";
    }
}

// Function to delete the ZIP file
function deleteZipFile($file) {
    if (unlink($file)) {
        echo "ZIP file deleted successfully.\n<br>";
    } else {
        echo "Failed to delete the ZIP file.\n<br>";
    }
}


// Function to handle folder upload and rename it to the domain name
function handleFolderUploadAndRename($folder, $uploadDir, $domain) {
    $projectDir = $uploadDir . $domain;
    mkdir($projectDir, 0777, true);
    
    foreach ($folder['name'] as $key => $filename) {
        $fileTmpName = $folder['tmp_name'][$key];
        $destination = $projectDir . '/' . $filename;

        // Create directory if it doesn't exist
        if (!file_exists(dirname($destination))) {
            mkdir(dirname($destination), 0777, true);
        }

        if (move_uploaded_file($fileTmpName, $destination)) {
            echo "File {$filename} uploaded successfully.<br>";
        } else {
            echo "Failed to upload file {$filename}.<br>";
        }
    }

    echo "Folder uploaded and renamed to: $domain<br>";
}


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the domain name
    $domain = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['domain']);
    if (empty($domain)) {
        die("Invalid domain name.<br>");
    }

    // Define the directory for the user's project
    $projectDir = $baseDir . $domain;
    // Check if the directory already exists
    if (file_exists($projectDir)) {
        die("Error: Subdomain already exists.<br>");
    }

    // Check if the file is uploaded
    if (!isFileUploaded($_FILES['file'])) {
        die("No folder uploaded or folder upload error.<br>");
    }

    $uploadDir =  __DIR__."/../site/";
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    $newDirName = $projectDir;
   
    handleFileUpload($uploadFile);
    $exfile = extractZipFile($uploadFile, $uploadDir, $newDirName);

    //run python script to find path to index file
    $index_path = shell_exec("python3 scripts/script.py ../site/".$domain);
    print($index_path);

    //create a conf file in sites-available
    $apache_conf = shell_exec("python3 scripts/apache.py ".$domain.".gosite.in"." ".$index_path);
    print($apache_conf);

    //enable the site
    $enable_site = shell_exec("scripts/./enableSite.sh ".$domain.".gosite.in".".conf");



} else {
    die("Invalid request.");
}

?>

<h1>Your site is hosted on "<?php printf($domain . ".gosite.in"); ?>"</h1>

</body>
</html>
