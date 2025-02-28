<?php
include 'libs/load.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  
    <? load('head') ?>

</head>
<body>
    <!-- Navbar -->

    <? load('navbar'); 
    // print( $_SERVER['HTTP_USER_AGENT']);
    ?>
    <!-- <button id="dark-mode-toggle">Toggle Dark Mode</button> -->


    <!-- banner Section -->
 
    <? load('banner'); ?>


    <!-- Pricing Section -->

    <? load('pricing'); ?>


    <!-- Upload Section -->
    
    <?
    if(Session::get('is_login')){
    // load('form') ;
    }
    ?>



    <? load('footer'); ?>


</body>
</html>