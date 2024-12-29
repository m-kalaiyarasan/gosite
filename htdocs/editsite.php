<?php
include 'libs/load.php';


print_r($_POST);


$id = $_POST['id'];
$name = $_POST['name'];
$status = $_POST['status'];
$action = $_POST['action'];
if($status == 'Active'){
    $status = 1;
}
else{
    $status = 0;
}

$baseDir = __DIR__."/../site/";
$changeDir = $baseDir . $name;



if(isset($_POST['action']) && $_POST['action'] == 'save'){
    $purchase = new Purchase(Session::get('session_user'));
    $result = $purchase->updatedetails($id, $name, $status);
    if($result){
        Conf::createConf($name);
        header('Location: dashboard.php?manage');
        exit;
    }
    else{
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