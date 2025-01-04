
<?php

use LanguageServer\Cache\Cache;
use Microsoft\PhpParser\Node\Expression\IssetIntrinsicExpression;
use TestNamespace\Example;

$sign = false;  
try{
  if(isset($_POST['username']) and !empty($_POST['username']) and isset($_POST['password']) and !empty($_POST['password']) and isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['phone'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sign = true;
    //var_dump($sign);
    if(!User::signup($username,$password,$email,$phone)){
      throw new Exception("aild to insert");
         
    }
   
  }
}
catch (Exception $e) {
  $error = $e->getMessage(); // Capture the error message
  if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
    if (strpos($e->getMessage(), 'for key \'auth.email\'') !== false) {
      $error = "Email is already registered.";
    } elseif (strpos($e->getMessage(), 'for key \'auth.username\'') !== false) {
      $error = "Username already exists.";
    } else {
      $error= "Something went wrong. Please try again.";
    }
} else {
  $error= "An unexpected error occurred.";
}
}
//var_dump($sign);
//print($sign ? "Signup success" : "Signup failed");
?>


<?php

 if($sign){
  if(!$error){

    ?>
      <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <center><h1 class="display-4">Signup sucess</h1>
    <p class="lead">Now you can login from here</p>
    <a class="btn btn-primary ms-2" href="login.php">Login</a></center>
  </div>
</div>

    
    
    <?php   

  }
  else{
  ?>
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <center>
    <h1 class="display-4">Signup Failed</h1>
    <p class="lead"><?=$error?></a></p>
     <!-- <a class="btn btn-primary" href="signup.php">Try again</a> -->
    <!-- <a class="btn btn-primary ms-2" href="login.php">Login</a> -->
     </center>
  </div>
</div>
<main class="form-signup">

<form class="formm" method="post" action="signup.php">
  <!-- <center><img class="mb-4" src="logo.png" alt="" width="80" height="70"> -->
  <!-- <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1> -->

</center>
<center>
    <h1 class="h3 mb-3 color-1">Sign up</h1>
    </center>

  <div class="form-floating">
    <input name="username" type="text" class="form-control" id="floatingInputusername" placeholder="username" required>
    <label for="floatingInputusername">Username</label>
  </div>
  <div class="form-floating">
    <input name="phone" type="text" class="form-control" id="floatingInputphone" placeholder="xxxxxxxxxx" required>
    <label for="floatingInputphone">Phone</label>
  </div>
  <div class="form-floating">
    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating">
    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>

  <button id="bttn" class="w-100 btn btn-lg btn-primary hvr-wobble-skew" type="submit">Sign Up</button>
</form>
<div class="mt-5 ">
</div>
</main> 

<?php
 }
 }
 else{
?>
<main class="form-signup">

<?

if($error){
  echo '<p class="lead"><?=$error?></a></p>';
}

?>

<form class="formm" method="post" action="signup.php">
<!-- <center><img class="mb-4" src="logo.png" alt="" width="80" height="70"> -->
<!-- <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1> -->


</center>
<center>
    <h1 class="h3 mb-3 color-1">Sign up</h1>
    </center>

  

  <div class="form-floating">
    <input name="username" type="text" class="form-control" id="floatingInputusername" placeholder="username" required>
    <label for="floatingInputusername">Username</label>
  </div>
  <div class="form-floating">
    <input name="phone" type="text" class="form-control" id="floatingInputphone" placeholder="xxxxxxxxxx" required>
    <label for="floatingInputphone">Phone</label>
  </div>
  <div class="form-floating">
    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating">
    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>

  <button id="bttn" class="w-100 btn btn-lg btn-primary hvr-wobble-skew" type="submit">Sign Up</button>
</form>
<div class="mt-5 ">
    <h6>Already have an account ?   <a class="btn btn-primary ms-2" href="login.php">Login</a></h6>
</div>
</main> 

<?php
 }



?>
