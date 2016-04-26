<?php  
  
require("phpMailer/class.phpmailer.php");  
require("phpMailer/class.smtp.php");   

$mail             = new PHPMailer();

$body             = "ñaca";
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.tantacom.com"; // SMTP server
$mail->SMTPAuth  = true;
$mail->Username = "pruebas@tantacom.com";
$mail->Password = "123456";

$mail->From       = "name@yourdomain.com";
$mail->FromName   = "First Last";

$mail->Subject    = "PHPMailer Test Subject via smtp";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress("carlos.revillo@tantacom.com");

            // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

  
   
?>