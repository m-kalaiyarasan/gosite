<?php
include 'libs/load.php';

if(UserSession::authorize($_SESSION['session_token'])){



    if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK)
    {
        $File = $baseDir . basename($_FILES['file']['name']);
        // print("enter in line 19");
    }
    elseif(isset($_POST['git']) && !empty($_POST['git'])){
        
        if(Upload::isValidGitLink($_POST['git'])){
            $File = $_POST['git'];
            echo "Valid Git link!";
        }else{
            
            
            $errorMessage = "Invalid Git link!";
            header("Location: /dashboard.php?error=$errorMessage");
            exit();
        }
        // print("enter in line 23");
    }
    else{
        throw new Exception("enter git link or upload files");
        die("enter git link or upload files");
    }



    $domain= "none";
    $baseDir = __DIR__."/../site/";
    // $File = $baseDir . basename($_FILES['file']['name']);

    $upload = new Upload($baseDir, $File);

    if(($_POST['domainType'] == 'custom')){

        // $serverIp = "192.168.1.100";
        $domain= $_POST['domain'];
        if ($upload->isValidDomain($domain)) {
    
            if (!$upload->isDomainPointedToServer($domain, $serverIp)) {
                throw new Exception("The domain is not pointed to your server.");
            }
    
        } else {
            throw new Exception("Invalid custom domain");
        }
        
       
    }




}

