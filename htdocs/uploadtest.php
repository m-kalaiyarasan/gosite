<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

include 'libs/load.php';

$baseDir = __DIR__."/../site/";
$File = $baseDir . basename($_FILES['file']['name']);
// $newDirName = $baseDir . $domain;

//build a object for Upload class

//check the user upload file or use git link, and make the functions accordingly
if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK)
{
    $File = $baseDir . basename($_FILES['file']['name']);
    print("enter in line 19");
}
elseif(isset($_POST['git']) && !empty($_POST['git'])){
    $File = $_POST['git'];
    print("enter in line 23");


}
else{
    die("enter git link or upload files");
}

$upload = new Upload($baseDir, $File);


//this is a main functions that execute after the cloning of repo or unzip of file,
function scripts($workdone,$domain,$newDirName){

    //   ---------------------------------------------------------------------------------------------- 
    //run python script to find path to index file
    $index_path = shell_exec("python3 scripts/script.py ../site/".$domain);

    // execute this if the index file is not in the user's project 
    if($index_path == 0){
        if (file_exists($newDirName)) {
        conf::deleteFolder($domain);
        die("fail to find index and deleted the file");
        }
        else{
            die("line 38 in uploadtest.php");

        }
    }
    
    //create a conf file in sites-available
    $name = 'test';

        print("<br>index path print : ".$index_path);
    Conf::changeapacheConfig($domain,$index_path);


    //enable the site
   Conf::enableSite($domain);
   Conf::reloadApache();

// -----------------------------------------------------------------------------------------------
    $plan_id = $_POST['plan_id'];
    $plan_name = $_POST['plan_name'];
        print($workdone);
        if ($workdone >= 3) {

            echo "Work done successfully!\n<br>";
            Database::getConnection();  
            if(Purchase::setdetails($domain,$plan_id,$plan_name ,$index_path )){
                echo "Domain details set successfully!\n<br>";
            } else {
                echo "Failed to set domain details!\n<br>";
            }
    
        } elseif($workdone <= 2) {
            echo "Work done partially!\n<br>";
        } else {
            echo "Work done failed!\n<br>";
        }
    }

    


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $domain = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['domain']);
    if (empty($domain)) {
        die("Invalid domain name.<br>");
    }
    $newDirName = $baseDir . $domain;
    // print($newDirName);

    // echo " <br  > wwwwwww <br>";
    // Check if the directory already exists
    if (file_exists($newDirName)) {
        die("Error: Subdomain already exists.<br>");    
    }
    else{
        echo " <br>  valid domain <br>";
    }

    $newDirName = $baseDir . $domain;

    if ($upload->isFileUploaded($_FILES['file'])) {

        $upload->handleFileUpload($File);
        $workdone = $upload->extractZipFile($File, $baseDir, $newDirName);
        scripts($workdone,$domain,$newDirName);
    }
    elseif(isset($_POST['git'])){

        $gitt = $upload->gitclone($domain);
        $workdone = 3;
        scripts($workdone,$domain,$newDirName);

    }
    else {
        $gitt = $upload->gitclone($domain);
        die("File not uploaded!");
    }
}

Conf::reloadApache();


// header("Location: dashboard.php?manage");
// $_SESSION['message'] = "Your site is successfully hosted on ".$domain.".gosite.in";
// exit;

