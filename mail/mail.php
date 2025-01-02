<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kalaiyarasan.offl.2004@gmail.com';
    $mail->Password = 'mibx yhoz gbjp jsrw';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('gosite.site@gmail.com', 'Mailer');
    $mail->addAddress('717822p321@kce.ac.in');

    $mail->Subject = 'Test Mail';
    $mail->Body    = 'This is a test email.';

    $mail->send();
    echo 'Mail sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
