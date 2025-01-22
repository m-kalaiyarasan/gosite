<?php
include 'libs/load.php';


print_r($_POST);


$id = $_POST['id'];
$name = $_POST['name'];
$status = $_POST['status'];
$action = $_POST['action'];
$oldName = $_POST['oldName'];
$path = $_POST['path'];
print($path);

if($status == 'Active'){
    $status = 1;
}
else{
    $status = 0;
}

$baseDir = __DIR__."/../site/";
$changeDir = $baseDir . $name;



if(isset($_POST['action']) && $_POST['action'] == 'save'){

    
    // $purchase = new Purchase(Session::get('session_user'));
    // $result = $purchase->updatedetails($id, $name, $status);
        // Conf::createConf($name);
        if (file_exists($changeDir)){
           die("domainname already exist");
        }
        print("hello");
        Conf::disableSite($oldName);
        Conf::deleteapacheConfig($oldName);
        Conf::renameFolder($oldName, $name);
        // Conf::updateApacheConf($oldName, $name);
        Conf::changeapacheConfig($name,$path);
        Conf::enableSite($name);
        Conf::reloadApache();


        // header('Location: dashboard.php?manage');
        // exit;
   
    
    $purchase = new Purchase(Session::get('session_user'));
    $result = $purchase->updatedetails($id, $name, $status);
    if(!$result){
        echo "Error";
    }

}

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
    $purchase = new Purchase(Session::get('session_user'));
    $result = $purchase->deletedetails($id);
    if($result){
        Conf::disableSite($name);
        Conf::deleteapacheConfig($name);
        Conf::reloadApache();
        conf::deleteFolder($name);
        header('Location: dashboard.php?manage');
        exit;
    }
    else{
        echo "Error";
    }
}