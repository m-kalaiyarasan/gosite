<?php

include_once 'includes/Database.class.php';
include_once 'includes/Session.class.php';
include_once 'includes/User.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/UserDetails.class.php';

function load($name){
    include "_templates/$name.php";
}
Session::start();