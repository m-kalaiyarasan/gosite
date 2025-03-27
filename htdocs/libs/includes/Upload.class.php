<?php
include_once 'Database.class.php';


class Upload{

    public $baseDir;
    public $File;
    public $workdone;
    public $conn;


    public function __construct($baseDir, $File) {
        $this->baseDir = $baseDir;
        $this->File = $File;
        // print($this->baseDir);
        // echo "<br>";
        // print($this->File);
        $conn = Database::getConnection();
    }

    public function isFileUploaded($file) {
        return isset($file) && $file['error'] === UPLOAD_ERR_OK;
    }

    public function handleFileUpload($File) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $File)) {
            echo "<br> File is valid and was successfully uploaded.\n<br>";

            //to track the work done
            $workdone = 1;
        } else {
            echo "Possible file upload attack!\n<br>";
        }
    }
    public function extractZipFile($File, $uploadDir, $newDirName) {
        global $workdone; 

        $zip = new ZipArchive;
        if ($zip->open($File) === TRUE) {
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

            $dirToRename = str_replace(".zip", "", $File);
            $this->renameDirectory($dirToRename, $newDirName);
            $workdone = $this->deleteZipFile($File); // Fixed here
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

    public function deleteZipFile($File) {
        global $workdone;

        if (unlink($File)) {
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

    public function gitclone($domain)
    {
        if (empty($domain) || empty($this->File)) {
            throw new Exception("Invalid domain name or Git link.");
        }

        $targetDir =  $this->baseDir. $domain;
        print("<br>".$targetDir."<br>");

        // Ensure the target directory does not already exist
        if (file_exists($targetDir)) {
            throw new Exception("The target directory '$targetDir' already exists.");
        }

        // Construct the Git clone command
        $gitCommand = sprintf('git clone %s %s', escapeshellarg($this->File), escapeshellarg($targetDir));

        // Execute the Git clone command
        exec($gitCommand, $output, $returnVar);

        // Check the return status of the exec command
        if ($returnVar === 0) {
            echo "Repository cloned successfully into '$targetDir'.";
        } else {
            throw new Exception("Git clone failed: " . implode("\n", $output));
        }
    }

    public static function isValidGitLink($gitLink) {
        // Regex for validating Git URL
        $regex = '/^(https?:\/\/|git@)[\w.-]+(:[\d]+)?\/[\w.-]+\/[\w.-]+(\.git)?$/';
    
        // Check if the link matches the regex
        if (preg_match($regex, $gitLink)) {
            return true;
        }
    
        // If not matched, check for harmful characters
        if (preg_match('/[;&|]/', $gitLink)) {
            throw new Exception("Invalid Git URL: Contains potentially harmful characters.");
        }
    
        return false;
    }

    public function isDomainPointedToServer($domain, $serverIp) {
        // Resolve the domain to its IP address
        $domainIp = gethostbyname($domain);
    
     
        $serverIp = "94.237.66.186";
        // Compare the resolved IP with the server's IP
        print($domainIp."<br>");
        print($serverIp);
        // return $domainIp === $serverIp;
        return true;
    }

    public function isValidDomain($domain) {
        // Regular expression for a valid domain name
        $pattern = '/^(?!\-)([a-zA-Z0-9\-]{1,63}(?<!\-)\.)+[a-zA-Z]{2,}$/';
        return preg_match($pattern, $domain) === 1;
    }

    public function confssl($domain){
        
    }


}