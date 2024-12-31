<?php

include_once 'includes/Database.class.php';
include_once 'includes/Session.class.php';
include_once 'includes/User.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/UserDetails.class.php';
include_once 'includes/Purchase.class.php';
include_once 'includes/Upload.class.php';
include_once 'includes/Conf.class.php';
include_once 'includes/Subscription.class.php';

function load($name){
    include "_templates/$name.php";
}
Session::start();

global $__site_config;
$__site_config_path = __DIR__.'/../../project/gosite.json';
$__site_config = file_get_contents($__site_config_path);


function get_config($key, $default=null)
{
   global $__site_config;
   $array = json_decode($__site_config, true);
   if (isset($array[$key])){
        return $array[$key];
   }
   else{
    return $default;
   }  
}
