<?
include 'libs/load.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?load('head');?>
 <link rel="stylesheet" href="css/login.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
</head>
<body>
    
<!-- login fail message -->


<?load('navbar');?>

<div class="pt-5">
<div class="pt-5">

<main class="form-signin">

  <form method="post" action="logintest.php">
    <!-- <center> <img class="mb-4" src="_templates/dys.png" alt="" width="80" height="70"></center> -->
   
    <center>
    <h1 class="h3 mb-3 color-1">Login in</h1>
    </center>

    <div class="form-floating">
      <input name="user" type="name" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Username or Email</label>
    </div>
    <div class="pt-2 pb-2 form-floating">
      <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    <input type="hidden" name="fingerprint" id="fingerprint">
    

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary hvr-wobble-skew" type="button" data-toggle="modal" data-target="#exampleModalCenter">Logn in</button>

  <div class="mt-5 ">
    <h6>Don't have an account ?   <a class="btn btn-primary ms-2" href="signup.php">Signup</a></h6>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Login success !
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Go to Homepage</button>
            </div>
        </div>
    </div>
</div>
</form>
<div class="pt-5">
    <div class="pt-5">
        <div class="mt-5">
            <?php load('footer'); ?>
        </div>
    </div>
</div>

<!-- Ensure modal triggers properly -->
<script>
    $('#exampleModalCenter').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    });
</script>


</main> 
<script>
  // Initialize the agent at application startup.
  const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
    .then(FingerprintJS => FingerprintJS.load());

  // Get the visitor identifier when you need it.
  fpPromise
    .then(fp => fp.get())
    .then(result => {
      // This is the visitor identifier:
      const visitorId = result.visitorId;
      console.log(visitorId);

      // Set the visitorId in the hidden input field
      document.getElementById('fingerprint').value = visitorId;
    });
</script>




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