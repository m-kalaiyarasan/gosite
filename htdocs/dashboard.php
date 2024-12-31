<?php
include 'libs/load.php';?>

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
<main>
<? load('dashboard'); 
if (isset($_GET['manage'])) {
  load('manage');
}
if(isset($_GET['database'])) {
    load('soon');
}
if(isset($_GET['host'])) {
    load('test');
}



//success message for domain host
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  //print the message dont dive an alert
  echo "<div class='alert alert-success' role='alert'>$message</div>";
  unset($_SESSION['message']); // Clear the message after displaying it
}
?>
</main>

<? load('footer'); ?>
</body>
</html>


<!-- sed -i "s|DocumentRoot .*|DocumentRoot /var/www/html/htdocs|" /etc/apache2/sites-available/000-default.conf -->
