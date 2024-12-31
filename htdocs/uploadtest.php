<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

include 'libs/load.php';

$baseDir = __DIR__."/../site/";
$uploadFile = $baseDir . basename($_FILES['file']['name']);
// $newDirName = $baseDir . $domain;

//build a object for Upload class
$upload = new Upload($baseDir, $uploadFile);


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

        $upload->handleFileUpload($uploadFile);
        $workdone = $upload->extractZipFile($uploadFile, $baseDir, $newDirName);

                           //scripts to handle apache configuration
//   ---------------------------------------------------------------------------------------------- 
    //run python script to find path to index file
    $index_path = shell_exec("python3 scripts/script.py ../site/".$domain);
    //create a conf file in sites-available
    $name = 'test';

        print("<br>index path print : ".$index_path);
    Conf::changeapacheConfig($domain,$index_path);

    // $apache_conf = shell_exec("python3 scripts/apache.py ".$domain.".gosite.in"." ".$index_path);

    //enable the site
    // $enable_site = shell_exec("scripts/./enableSite.sh ".$domain.".gosite".".conf");
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

    else {
        echo "File not uploaded!";
    }
}

Conf::reloadApache();


// header("Location: dashboard.php?manage");
$_SESSION['message'] = "Your site is successfully hosted on ".$domain.".gosite.in";
exit;

