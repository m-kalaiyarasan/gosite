<!-- <div class="container mt-5">
        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Caution: Read instructions carefully!">
            ℹ️
        </span>
    </div> -->


    <?php

include 'libs/load.php';

$username = $_SESSION['session_user'];

$wp = new Wordpress();
$user_id = $username."_".rand(100,200);

// $port = $wp->findAvailablePort();
$lastPort = $wp->findLastPort();
$port = $lastPort+1;
$user_id = $username."_".$port;


$create = $wp->setupWordPress($user_id,$port);
$wp->updatePortCount($port); 

// print($port);
echo"<pre>";
print_r($create);
echo"<pre>";
// print($port+1);