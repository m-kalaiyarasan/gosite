<?php

include 'libs/load.php';

if(UserSession::authorize($_SESSION['session_token'])){

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <? load('head'); ?>
<link href="css/dashboard.css" rel="stylesheet">
</head>
<body>

<? load('dashboard'); ?>

<? //load('footer'); ?>

</body>
</html>

<?
}
?>
