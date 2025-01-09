<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Get email from form
$toEmail = $_GET['email'];
print("hello");
print($toEmail);

// Generate OTP and save it in the session
$otp = rand(100000, 999999); // 6-digit OTP
$_SESSION['otp'] = $otp;
$_SESSION['email'] = $toEmail;

// Send OTP via PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'gosite.site@gmail.com'; // Replace with your email
    $mail->Password = 'oewo xdfe xefn qxdw'; // Replace with your email app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email settings
    $mail->setFrom('gosite.site@gmail.com', 'GoSite OTP Verification');
    $mail->addAddress($toEmail);
    $mail->Subject = 'Your OTP Code';
    $mail->Body = "Your OTP for signup is: $otp\n\nPlease do not share this code with anyone.";

    $mail->send();
    echo "OTP sent successfully to $toEmail";
    header('Location: ../signup.php?verify');
    exit;
} catch (Exception $e) {
    echo "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
}


?>
