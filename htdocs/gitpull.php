<?php
include 'libs/load.php';


echo "<pre>";
print_r($_POST);
echo "</pre>";
$id = $_POST['id'];
$username = $_SESSION['session_user'];
print($username);

$purchase = new Purchase($username);

$values = $purchase->gitdetails($id);


print($gitlink);
$domain = $values['domain'];

echo "<pre>";
print_r($values);
echo "</pre>";

conf::deleteFolder($domain);

$gitlink = $values['git_repo'];
$targetDir = "../site/".$domain ;
 // Construct the Git clone command
 $gitCommand = sprintf('git clone %s %s', escapeshellarg($gitlink), escapeshellarg($targetDir));

 // Execute the Git clone command
$return =  exec($gitCommand, $output, $returnVar);

// $return = shell_exec("git pull ../site/".$domain);

// print_r($output);
// print_r($output);


header("Location: dashboard.php?manage");
// $_SESSION['message'] = "Your site is successfully hosted on ".$domain.".gosite.in";
exit;