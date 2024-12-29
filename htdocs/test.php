<?php

//test the apache conf edit 


include 'libs/load.php';
$name = 'test';
$baseDir = __DIR__."/../site/";
$changeDir = $baseDir . $name;

Conf::changeapacheConfig($name,$changeDir);
