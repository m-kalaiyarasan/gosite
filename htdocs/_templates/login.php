
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
    <button class="w-100 btn btn-lg btn-primary hvr-wobble-skew" type="submit">Logn in</button>
  </form>
  <div class="mt-5 ">
    <h6>Don't have an account ?   <a class="btn btn-primary ms-2" href="signup.php">Signup</a></h6>
</div>

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



