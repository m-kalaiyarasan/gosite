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

<?load('login');?>

<footer class="footer fixed-bottom text-center ">
<?load('footer');?>
</footer>

</body>
</html>