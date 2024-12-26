<?
include 'libs/load.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?load('head');?>
 <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
<!-- login fail message -->
<?
if (isset($_GET['faild'])) {

    ?>
    <div class="alert alert-danger" role="alert">
        Login Faild, Please try again
    </div>
    <?

}
?>

<?load('navbar');?>

<div class="pt-5">
<div class="pt-5">
<?load('login');?>
</div>
</div>

<div class="pt-5">
<div class="pt-5">
<div class="mt-5">
<?load('footer');?>
</div>
</div>
</div>

</body>
</html>