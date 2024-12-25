
<main class="form-signup">

<form class="formm" method="post" action="signup.php">
  <!-- <center><img class="mb-4" src="_templates/dys.png" alt="" width="80" height="70"> -->
  <!-- <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1> -->
  <center>
  <h1 class="h3 mb-3 t-white">Sign Up</h1>

</center>

  

  <div class="form-floating pb-2 ">
    <input name="username" type="text" class="form-control" id="floatingInputusername" placeholder="username" required>
    <label for="floatingInputusername">Username</label>
  </div>
  <div class="form-floating pb-2">
    <input name="phone" type="text" class="form-control" id="floatingInputphone" placeholder="xxxxxxxxxx" required>
    <label for="floatingInputphone">Phone</label>
  </div>
  <div class="form-floating pb-2">
    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating pb-2">
    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>

  <button id="bttn" class="w-100 btn btn-lg btn-primary hvr-wobble-skew" type="submit">Sign Up</button>
</form>
<div class="mt-5 ">
    <h6>Already have an account ?   <a class="btn btn-primary ms-2" href="login.php">Login</a></h6>
</div>
</main> 
