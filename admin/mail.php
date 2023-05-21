<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions


function mailSend($to, $cc, $subject, $text)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.triyatna.me';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contact.tri@triyatna.me';                     //SMTP username
        $mail->Password   = 'Zerz3231!';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('contact.tri@triyatna.me', 'Tri Yatna');
        // $mail->addAddress('triyatna.my@gmail.com', 'Joe User');     //Add a recipient
        $mail->addAddress($to);               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC($cc);
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $text;
        $mail->AltBody = 'Use HTML Mail Client to read this email';

        $mail->send();
        //     echo '<div class="alert alert-success bg-blue-grey rounded text-center"><strong>Success!!
        // </strong>Message has been sent</div>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
