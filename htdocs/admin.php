<?php

include 'libs/load.php';

if(UserSession::isAdmin()){

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <? load('head'); ?>
<link href="css/admindashboard.css" rel="stylesheet">
</head>
<body>

<? 

load('admin');

?>

<? //load('footer'); ?>

</body>
</html>

<?
}
else{
    header("Location: index.php");
    exit;
}

?>
