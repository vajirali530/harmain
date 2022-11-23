<?php
defined('BASE_URL') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
    $mail->SMTPDebug = false;                                   // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = MAIL_USERNAME;                          // SMTP username
    $mail->Password   = MAIL_USER_PASSWORD;                     // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	
    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true
    //     )
    // );

    //Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($to);

    $mail->isHTML(true);        
    $mail->Subject = $subject;
    $message = "DBKS";
    $mail->Body    = $message;
    try {
        $mail->send();
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    } 
    if(isset($attachment) && $attachment[0] != '' && $attachment[1] != ''){
        $mail->addAttachment($attachment[0], $attachment[1]);
    }
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg')
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        $status = true;
    }
    else{
        $status = false;
    }
} catch (Exception $e) {
    $status = false;
}