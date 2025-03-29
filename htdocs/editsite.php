<?php
include 'libs/load.php';


print_r($_POST);


$id = $_POST['id'];
$name = $_POST['name'];
$status = $_POST['status'];
$action = $_POST['action'];
$oldName = $_POST['oldName'];
$path = $_POST['path'];

$pathParts = explode('/', $path);

$pathParts[count($pathParts) - 1] = $name;

$newPath = implode('/', $pathParts);



print($path);



if($status == 'Active'){
    $status = 1;
    Conf::enableSite($name);
    Conf::reloadApache();
}
else{
    $status = 0;
    Conf::disableSite($name);
    Conf::reloadApache();
}

$baseDir = __DIR__."/../site/";
$changeDir = $baseDir . $name;



if(isset($_POST['action']) && $_POST['action'] == 'save'){

    
    // $purchase = new Purchase(Session::get('session_user'));
    // $result = $purchase->updatedetails($id, $name, $status);
        // Conf::createConf($name);
        if($oldName != $name){
        if (file_exists($changeDir)){
            // die("Domain already exists, use another domains");
            header('Location: dashboard.php?manage');
            $_SESSION['message'] = "Domain already exists, use another domains";
            exit;
            // $oldName = $name;
            }
        
        print("hello");
        Conf::disableSite($oldName);
        Conf::deleteapacheConfig($oldName);
        Conf::renameFolder($oldName, $name);
        // Conf::updateApacheConf($oldName, $name);
        Conf::changeapacheConfig($name,$newPath);
        Conf::enableSite($name);
        Conf::reloadApache();
        }
    
    $purchase = new Purchase(Session::get('session_user'));
    $result = $purchase->updatedetails($id, $name, $status);
    if(!$result){
        echo "Error";
    }
    header('Location: dashboard.php?manage');
    $_SESSION['message'] = "Changes updated updated successfully";
    exit;

}

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
    $purchase = new Purchase(Session::get('session_user'));
    $result = $purchase->deletedetails($id);
    if($result){
        Conf::disableSite($name);
        // Conf::deletesslConfig($name);
        Conf::reloadApache();
        conf::deleteFolder($name);
        conf::delconfssl($name);
        Conf::deleteapacheConfig($name);

        header('Location: dashboard.php?manage');
        exit;
    }
    else{
        echo "Error";
    }
}
