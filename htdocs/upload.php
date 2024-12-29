<?
include 'libs/load.php';

?>

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



// Function to handle file upload
function handleFileUpload($uploadFile) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        echo "<br> File is valid and was successfully uploaded.\n<br>";

        //to track the work done
        $workdone = 1;
    } else {
        echo "Possible file upload attack!\n<br>";
    }
}

function extractZipFile($uploadFile, $uploadDir, $newDirName) {
    global $workdone; 

    $zip = new ZipArchive;
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

        //to track the work done
        $workdone = $workdone + 1;

        $dirToRename = str_replace(".zip", "", $uploadFile);
        renameDirectory($dirToRename, $newDirName);
        deleteZipFile($uploadFile);
    } else {
        echo "Failed to open ZIP file.\n<br>";
    }

}

// Function to rename directory
function renameDirectory($dirToRename, $newDirName) {
    global $workdone; // Declare global variable

    if (rename($dirToRename, $newDirName)) {
        echo "Directory renamed to: $newDirName\n<br>";

        //to track the work done
        $workdone = $workdone + 1;
        // print($workdone);
    } else {
        echo "Failed to rename the directory.\n<br>";
    }
}

function deleteZipFile($file) {
    global $workdone; // Declare global variable

    if (unlink($file)) {
        echo "ZIP file deleted successfully.\n<br>";
        $workdone = $workdone + 1;
    } else {
        echo "Failed to delete the ZIP file.\n<br>";
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $domain = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['domain']);
    if (empty($domain)) {
        die("Invalid domain name.<br>");
    }

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
    $newDirName = $projectDir;
   
    handleFileUpload($uploadFile);
    extractZipFile($uploadFile, $uploadDir, $newDirName);


                    //scripts to handle apache configuration
//   ---------------------------------------------------------------------------------------------- 
    //run python script to find path to index file
    $index_path = shell_exec("python3 scripts/script.py ../site/".$domain);
    //create a conf file in sites-available
    $apache_conf = shell_exec("python3 scripts/apache.py ".$domain.".gosite.in"." ".$index_path);

    //enable the site
    $enable_site = shell_exec("scripts/./enableSite.sh ".$domain.".gosite.in".".conf");
// -----------------------------------------------------------------------------------------------

    print($workdone);

    // Check if the work is done
    if ($workdone === 3) {

        echo "Work done successfully!\n<br>";
        Database::getConnection();  
        if(Purchase::setdetails($domain, "basic",$index_path )){
            echo "Domain details set successfully!\n<br>";
        } else {
            echo "Failed to set domain details!\n<br>";
        }

    } elseif($workdone >= 2) {
        echo "Work done partially!\n<br>";
    }
    else {
        echo "Work done failed!\n<br>";
    }

} else {
    die("Invalid request.");
}



?>


<h1>Your site is hosted on "<?php printf($domain . ".gosite.in"); ?>"</h1>

</body>
</html>

<!-- write a javascript alert -->



<?php
header("Location: dashboard.php?manage");
$_SESSION['message'] = "Your site is successfully hosted on ".$domain.".gosite.in";
exit;
?>