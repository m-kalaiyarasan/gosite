<?php

$from = $_REQUEST['email'];
$name = $_REQUEST['name'];
$subject = $_REQUEST['subject'];
$number = $_REQUEST['number'];
$message = $_REQUEST['message'];
$mobile = $_REQUEST['mobile'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'kalaiyarasan.offl.2004@gmail.com'; // Replace with your email address
    $mail->Password = 'mibx yhoz gbjp jsrw'; // Replace with your email password
    $mail->SMTPSecure = 'tls'; // 'tls' can also be used
    $mail->Port = 587; // SMTP port (e.g., 587 for TLS, 465 for SSL)

    // Recipients
    $mail->setFrom($from, $name."test"); // Sender's details
    $mail->addAddress($from); 
    
    // Recipient's email

    $mail->setFrom('gosite.site@gmail.com', 'Website Contact Form');
    $mail->addAddress('717822p321@kce.ac.in');

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
            <p><strong>Email:</strong> $from</p>
            <p><strong>Phone Number:</strong> $mobile</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </div>
    </body>
    </html>";

    // Email body (Plain text fallback)
    $mail->AltBody = "Name: $name\nEmail: $from\nPhone Number: $number\nSubject: $subject\nMessage: $message";

    // Send the email
    $mail->send();
    echo 'Mail sent successfully.';

    header("Location: ../index.php");
    exit;
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
