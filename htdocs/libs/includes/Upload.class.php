<?php
include_once 'Database.class.php';


class Upload{

    public $baseDir;
    public $uploadFile;
    public $workdone;
    public $conn;


    public function __construct($baseDir, $uploadFile) {
        $this->baseDir = $baseDir;
        $this->uploadFile = $uploadFile;
        // print($this->baseDir);
        // echo "<br>";
        // print($this->uploadFile);
        $conn = Database::getConnection();
    }

    public function isFileUploaded($file) {
        return isset($file) && $file['error'] === UPLOAD_ERR_OK;
    }

    public function handleFileUpload($uploadFile) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "<br> File is valid and was successfully uploaded.\n<br>";

            //to track the work done
            $workdone = 1;
        } else {
            echo "Possible file upload attack!\n<br>";
        }
    }
    public function extractZipFile($uploadFile, $uploadDir, $newDirName) {
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
            $this->renameDirectory($dirToRename, $newDirName);
            $workdone = $this->deleteZipFile($uploadFile); // Fixed here
            return $workdone;
        } else {
            echo "Failed to open ZIP file.\n<br>";
        }

    }

    public function renameDirectory($dirToRename, $newDirName) {
        global $workdone;

        if (rename($dirToRename, $newDirName)) {
            echo "Directory renamed to: $newDirName\n<br>";

            //to track the work done
            $workdone = $workdone + 1;
        } else {
            echo "Failed to rename the directory.\n<br>";
        }
    }

    public function deleteZipFile($uploadFile) {
        global $workdone;

        if (unlink($uploadFile)) {
            echo "ZIP file deleted successfully.\n<br>";
            $workdone = $workdone + 1;
            return $workdone;
        } else {
            echo "Failed to delete the ZIP file.\n<br>";
        }
    }

    public function changeapacheConfig($newDirName) {
        global $workdone;

        $apacheConfigFile = '/etc/apache2/sites-available/000-default.conf';
        $apacheConfig = file_get_contents($apacheConfigFile);
        $newApacheConfig = str_replace('DocumentRoot /var/www/html', "DocumentRoot /var/www/html/htdocs/$newDirName", $apacheConfig);

        if (file_put_contents($apacheConfigFile, $newApacheConfig)) {
            echo "Apache config updated successfully.\n<br>";
            $workdone = $workdone + 1;
            return $workdone;
        } else {    
            echo "Failed to update Apache config.\n<br>";
        }
    }



}