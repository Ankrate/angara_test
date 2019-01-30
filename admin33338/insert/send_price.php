<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require __DIR__ . '/../../config.php';
require __DIR__ . '/class.phpmailer.php';
require_once ('func.php');
$mailto = 'angara99@gmail.com';
$mailto1 = '9263479200@mail.ru';
$my_file = "angara.xls";
$my_path = __DIR__ . '/price/';
$my_name = "Angara77";
$my_mail = "angara77@gmail.com";
$my_replyto = "angara77@gmail.com";
$my_subject = "Прайс лист Ангара";
$my_message = "Здравствуйте уважаемые партнеры, В приложении прайс лист по автомобилю Портер1 и 2. С уважением компания Ангара";
//mail_attachment($my_file, $my_path, $mailto, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
//PHPMailer Object
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
//From email address and name
$mail->From = "angara77@gmail.com";
$mail->FromName = "Angara77";

//To address and name
$mail->addAddress("angara99@gmail.com", "Recepient Name");
$mail->addAddress($mailto1); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("angara77@gmail.com", "Reply");

//CC and BCC
//$mail->addCC($mail2);
//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = $my_subject;
$mail->Body = "<i>".$my_message."</i>";
//$mail->AltBody = "This is the plain text version of the email content";
$mail->AddAttachment($my_path.$my_file);

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}