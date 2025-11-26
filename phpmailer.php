<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include PHPMailer autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// Create a new PHPMailer instance
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // SMTP server address
    $mail->SMTPAuth   = true;                // Enable SMTP authentication
    $mail->Username   = 'billuj85@gmail.com';  // SMTP username
    $mail->Password   = 'wrki fcvt zuyd sxpl';     // SMTP password
    $mail->SMTPSecure = 'ssl';               // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                 // TCP port to connect to
    // Sender and recipient details
    $mail->setFrom('billuj85@gmail.com');
    $mail->addAddress($mailtoaddress);
    // Email subject and body
    $mail->Subject = '"Welcome to Discount Store"';
    $mail->Body    = $bodyContent;
    // Optional: Add attachments
   // $mail->addAttachment('/path/to/file.pdf');
    // Send the email
    $mail->send();
    echo"<script> alert('Registered Successfully'); window.location='index.php';</script>";
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>
