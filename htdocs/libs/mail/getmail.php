<?php
include '../load.php';

$name = $_REQUEST['fullname'];
$email = $_REQUEST['email'];
$mobile = $_REQUEST['phone'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'gosite.site@gmail.com'; // Replace with your email address
    $mail->Password = get_config('mail_key'); // Replace with your email password
    $mail->SMTPSecure = 'tls'; // 'tls' can also be used
    $mail->Port = 587; // SMTP port (e.g., 587 for TLS, 465 for SSL)

    // Recipients
    $mail->setFrom($email, 'Contact For gosite'); // Sender's details
    $mail->addAddress('kalaiyarasan.offl.2004@gmail.com','kalaiyarasan.offl@gmail.com');
    
    // Recipient's email

    // $mail->setFrom('gosite.site@gmail.com', 'Website Contact Form');
    // $mail->addAddress('717822p321@kce.ac.in');

    // Data from the form


    // Email subject
    $mail->Subject = "New Inquiry from $name: $subject";

    // Email body (HTML)
    $mail->Body = "
      <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
            }
            .container {
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
                width: 80%;
                margin: auto;
            }
            h2 {
                color: #0056b3;
            }
            p {
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>New Inquiry Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone Number:</strong> $mobile</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </div>
    </body>
    </html>
    ";

    // Email body (Plain text fallback)
    $mail->AltBody = "Name: $name\nEmail: $from\nPhone Number: $number\nSubject: $subject\nMessage: $message";

    // Send the email
    $mail->send();
    echo 'Mail sent successfully.';

        header("Location: ../../index.php");
        exit;
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
