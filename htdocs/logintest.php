<?php

include 'libs/load.php';
$visitorId = $_POST['fingerprint'] ;
print("JS finger print : ".$visitorId);

$user = $_POST['user'];
$pass =$_POST['pass'];
$result = null;
print($user);
print($pass);

// $user = "kalaiyarasan";
// $pass = "kalai";
// print($user);
// print($pass);


if (isset($_GET['logout'])) {
  Session::destroy();
  exit("Session destroyed, <a href='login.php'>Login Again</a>");

}

print_r($_SESSION);

if(Session::get('is_login'))
{
  printf("Already login. ");
    // $userdata = Session::get('session_user');
    // $userobj = new User($user);

    ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">  <? print("hello welcome");//print("Welcome Back, ".$userobj->getFirstname()); ?></h1>
          <h1> <? 
          // $token = UserSession::authenticate($user,$pass);
          // $userSessionObj = new UserSession($token);
          // print($userSessionObj->getFingerprint());
        
          ?>  </h1>
        </div>
      </div>
    
    <?
    
    $result = $userdata;
}
else
{
    printf("Trying to login. ");
    $result = User::login($user,$pass);
    if($result)
    {
        ?>    
        <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Login Sucess, <? print($result);; ?></h1>
          <br><h1> <?// print($userobj->getFirstname); ?>  </h1>
        </div>
      </div>
        <?
        // echo " login Sucess, $result[username]";
        Session::set('is_login',true);
        Session::set('session_user',$result);
        //print the above session
    
    }
    else{
        echo "login failed";
    }
}

echo <<<EOL
<br><br><a href="logintest.php?logout">Logout</a>
EOL;

?>

<?php
   header("Location: index.php");
   exit;
?>