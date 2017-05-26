<?php
include 'config.inc.php';
require 'mail/PHPMailerAutoload.php';

$subject = $_POST['subject'];
$body = $_POST['body'];
$AltBody = $_POST['altbody'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $smtp;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $smtp_username;                 // SMTP username
$mail->Password = $smtp_password;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $smtp_port;                                    // TCP port to connect to

$mail->setFrom('danmed@gmail.com', 'Mailer');
$mail->addAddress('dan.medhurst@planb.co.uk', 'Dan Medhurst');     // Add a recipient
$mail->addReplyTo('danmed@gmail.com', 'PStatus');

$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = $altbody;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
