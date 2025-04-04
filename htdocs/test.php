<!-- <div class="container mt-5">
        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Caution: Read instructions carefully!">
            ℹ️
        </span>
    </div> -->


    <?php

include 'libs/load.php';

$wp = new Wordpress();
$user_id = rand(100,200);

$port = $wp->findAvailablePort();
$create = $wp->setupWordPress($user_id,$port);

echo"<pre>";
print_r($create);
echo"<pre>";
print($port);