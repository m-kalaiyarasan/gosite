<?php
session_start();

$inputOtp = $_POST['otp'];
$savedOtp = $_SESSION['otp'] ?? null;

if ($savedOtp && $inputOtp == $savedOtp) {
    echo "OTP verified successfully!";
    Session::set('verified',true);
    unset($_SESSION['otp']); // Clear OTP after successful verification
} else {
    echo "Invalid or expired OTP.";
}
?>
