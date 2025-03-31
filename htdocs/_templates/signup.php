
<?php

use LanguageServer\Cache\Cache;
use Microsoft\PhpParser\Node\Expression\IssetIntrinsicExpression;
use TestNamespace\Example;

if(Session::get('is_login'))
{
    header("Location: index.php");
    exit;
}


$sign = false;
try{
  if(isset($_GET['done']))
  {
    $inputOtp = $_GET['done'];
  $savedOtp = $_SESSION['otp'] ?? null;

if ($savedOtp && $inputOtp == $savedOtp) {
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $email = $_SESSION['email'];
  $phone = $_SESSION['phone'];
  $sign = true;
  if(!User::signup($username,$password,$email,$phone)){
    throw new Exception("aild to insert");
  }
  if(!Purchase::freePlanUp($username)){
    throw new Exception("Free plan not asign, please contact at Gosite");
  }
  
  // User::active(1);
  unset($_SESSION['otp']);
  unset($_SESSION['username']);
  unset($_SESSION['email']);
  unset($_SESSION['phone']);
  unset($_SESSION['phone']);
  header("Location: success.php");
  exit; 
} else {
    echo "Invalid or expired OTP.";
}

}


  if(isset($_POST['username']) and !empty($_POST['username']) and isset($_POST['password']) and !empty($_POST['password']) and isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['phone'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sign = true;

    if(User::getdata('email',$email)){
      // print("ex");
     throw new Exception(3);
    }
    elseif(User::getdata('username',$username)){
      throw new Exception(4);
      // die("duplicate email");
    }
    
    if(strlen($username) < 5 ){
      throw new Exception(5);
    }
    if(strlen($password)<8){
      throw new Exception(6);
    }
    Session::set('username',$username);
    Session::set('password',$password);
    Session::set('email',$email);
    Session::set('phone',$phone);

    // print(strlen($username));
    // print($username);
    Otp::SendOtp($email);

    //var_dump($sign);
    if(!User::signup($username,$password,$email,$phone)){
      throw new Exception("aild to insert");
    }
    else{
      // header("Location: otp/send-otp.php?email=$email");
      // exit;
      // Otp::SendOtp($email);
      
      ?>
      <!-- <form action="otp/send-otp.php" method="post" > -->

      <?
    }
   
  }
}
catch (Exception $e) {

  $error = $e->getMessage();
  print($error);
 // Capture the error message
  if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
    if (strpos($e->getMessage(), 'for key \'auth.email\'') !== false) {
      $error = "Email is already registered, Please login.";
    } elseif (strpos($e->getMessage(), 'for key \'auth.username\'') !== false) {
      $error = "Username already exists.";
    } else {
      $error= "Something went wrong. Please try again.";
    }
} else {
  if ($error == 5) {

    $error = "Username must be greater than 4 characters.";
  }
  elseif($error == 6){
    $error= "password length must be atleast 8";
  }
  elseif($error == 3){
    $error= "Email is already registered, Please login.";
  }
  elseif($error == 4){
    $error= "Username already exists.";
  }
    else{
  $error= "An unexpected error occurred.";
  }
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

 elseif(isset($_GET['done'])){
 
  ?>
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <center><h1 class="display-4">Signup sucess</h1>
    <p class="lead">Now you can login from here</p>
    <a class="btn btn-primary ms-2" href="login.php">Login</a></center>
  </div>
</div>
  <?

 }
 elseif(isset($_GET['verify'])){
  if (!isset($_SESSION['otp'])) {
    echo "otp is not generated";    
}


  ?>
   <!-- <h1>Guess the Number Game</h1>
    <p>I am thinking of a number between 1 and 100. Can you guess it?</p>
    <h2>Verify OTP</h2>

    <label for="otp">Enter OTP:</label>
    <input type="number" id="otp" name="otp" required>
    <button onclick="otpverify()">Submit</button>
    <p class="feedback" id="feedback"></p> -->

  
  <main class="form-signup">


  <!-- <center><img class="mb-4" src="logo.png" alt="" width="80" height="70"> -->
  <!-- <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1> -->

</center>
<center>
    <h1 class="h3 mb-3 color-1">Verify OTP</h1>
    <p>Check in Spam Folder</p>
    </center>

  <div class="form-floating">
    <input name="otp" type="number" class="form-control" id="otp" placeholder="otp" required>
    <label for="otp">OTP</label>
  </div>
  <button onclick="otpverify()" id="bttn" class="mt-4 w-100 btn btn-lg btn-primary hvr-wobble-skew" type="button">Verify</button>
  <p class="feedback" id="feedback"></p>

<div class="mt-5 ">
</div>
</main> 
</div>

    <!-- <form method="POST" action="verify-otp.php">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>  -->
  <?


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


// print_r($_SESSION);
?>
    <script>
        // Get OTP from PHP session
        const totp = <?= json_encode($_SESSION['otp']) ?>;
        let attempts = 0;

        function otpverify() {
            const otp = parseInt(document.getElementById('otp').value);
            const feedback = document.getElementById('feedback');
            attempts++;

            if (otp === totp) {
                feedback.textContent = `OTP verified Successfully.`;
                <?
                Session::set('verified',true);
                User::active(1);
                // unset($_SESSION['otp']);
                ?>
                setTimeout(() => {
                window.location.href = 'signup.php?done=<?= json_encode($_SESSION['otp']) ?>'; // Replace with your success page
            }, 2000);
                feedback.style.color = "green";
                // Optionally reload the page or reset OTP after verification
                setTimeout(() => location.reload(), 5000);
            } else {
                feedback.textContent = "Incorrect OTP! Please try again.";
                feedback.style.color = "red";
            }
        }
    </script>