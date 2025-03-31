<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
  
    <h1>Signup</h1>
    <form method="POST" action="send-otp.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send OTP</button>
    </form>
    <?
    if(isset($_GET['verify'])){
    ?>
    <h2>Verify OTP</h2>
    <p>Check in Spam folder</p>
    <form method="POST" action="verify-otp.php">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>
    <?}?>
</body>
</html>
