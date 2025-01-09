<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

print_r($_SESSION);
// Generate OTP if not already set
if (!isset($_SESSION['otp'])) {
    echo "otp is not generated";    
}

// Check if the verification page is requested
if (isset($_GET['verify'])) {
?>
    <h1>Guess the Number Game</h1>
    <p>I am thinking of a number between 1 and 100. Can you guess it?</p>
    <h2>Verify OTP</h2>

    <label for="otp">Enter OTP:</label>
    <input type="number" id="otp" name="otp" required>
    <button onclick="otpverify()">Submit</button>
    <p class="feedback" id="feedback"></p>

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
                unset($_SESSION['otp']);
                ?>
                feedback.style.color = "green";
                // Optionally reload the page or reset OTP after verification
                setTimeout(() => location.reload(), 5000);
            } else {
                feedback.textContent = "Incorrect OTP! Please try again.";
                feedback.style.color = "red";
            }
        }
    </script>
<?php
}
?>

</body>
</html>