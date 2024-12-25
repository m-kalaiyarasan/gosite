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
$baseDir = "/home/kalai/htdocs/kalai/";

// Function to handle file upload
function handleFileUpload($uploadFile) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        echo "File is valid and was successfully uploaded.\n<br>";
    } else {
        echo "Possible file upload attack!\n<br>";
    }
}

// Function to extract ZIP file
function extractZipFile($uploadFile, $uploadDir, $newDirName) {
    $zip = new ZipArchive;
    if ($zip->open($uploadFile) === TRUE) {
        $zip->extractTo($uploadDir);
        $zip->close();
        echo "ZIP extracted successfully!\n<br>";

        $dirToRename = str_replace(".zip", "", $uploadFile);
        renameDirectory($dirToRename, $newDirName);
        deleteZipFile($uploadFile);
    } else {
        echo "Failed to open ZIP file.\n<br>";
    }
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

    $uploadDir = "/home/kalai/htdocs/kalai/";
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    $newDirName = $projectDir;

    handleFileUpload($uploadFile);
    extractZipFile($uploadFile, $uploadDir, $newDirName);

} else {
    die("Invalid request.");
}

?>

<h1>Your site is hosted on "<?php printf($domain . ".kalai.kalaiyarasan.me"); ?>"</h1>

</body>
</html>










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
$baseDir = "/home/kalai/htdocs/kalai/";

// Function to check if folder is uploaded
function isFolderUploaded($folder) {
    return isset($folder['name']) && !empty($folder['name'][0]);
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
    $uploadDir = "/home/kalai/htdocs/kalai/";
    $projectDir = $uploadDir . $domain;
    // Check if the directory already exists
    if (file_exists($projectDir)) {
        die("Error: Subdomain already exists.<br>");
    }

    // Handle folder upload
    if (isFolderUploaded($_FILES['folder'])) {
        handleFolderUploadAndRename($_FILES['folder'], $uploadDir, $domain);
    } else {
        die("No folder uploaded or folder upload error.<br>");
    }
} else {
    die("Invalid request.");
}

?>

<h1>Your site is hosted on "<?php printf($domain . ".kalai.kalaiyarasan.me"); ?>"</h1>

</body>
</html>
