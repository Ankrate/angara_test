<?php
ini_set('display_errors',1);
 $to = 'angara99@gmail.com'; 
 $subject = 'Test email using PHP'; 
 $message = 'This is a test email message'; 
 $headers = 'From: manhee' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
 $mail = mail($to, $subject, $message, $headers); 
 
 //$mail=mail($to, "Subject: $subject",$message );
if($mail){
  echo "Thank you for using our mail form";
}else{
  echo "Mail sending failed."; 
}
 
 
?>