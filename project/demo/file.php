<?php

$uploadDir = '/home/kalai/htdocs/kalai/'; // Define your upload directory

// Function to handle folder upload
function handleFolderUpload($files, $uploadDir) {
    foreach ($files['name'] as $key => $name) {
        // Skip empty file names
        if (empty($name)) {
            continue;
        }

        $tmpName = $files['tmp_name'][$key];
        $uploadFilePath = $uploadDir . $name;

        // Create directory if it doesn't exist
        if (!file_exists(dirname($uploadFilePath))) {
            mkdir(dirname($uploadFilePath), 0777, true);
        }

        // Move uploaded file to the desired directory
        if (move_uploaded_file($tmpName, $uploadFilePath)) {
            echo "File {$name} uploaded successfully.<br>";
        } else {
            echo "Failed to upload file {$name}.<br>";
        }
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle folder upload
    handleFolderUpload($_FILES['folder'], $uploadDir);
} else {
    echo "Invalid request.";
}
?>
