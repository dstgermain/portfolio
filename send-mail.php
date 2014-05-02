<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
 
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dstgermain.contact.form@gmail.com';// SMTP username
$mail->Password = 'ilmcm0463!';                       // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('dstgermain.contact.form@gmail.com', 'Form Mailer');     //Set who the message is to be sent from
$mail->addAddress($_POST["email"], $_POST["name"]);  //Set an alternative reply-to address
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Contact Form: ' . $_POST["name"];
$mail->Body    = '<html><body>'.
				'<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f0f0f0;"><tr><td align="center">'.
				'<table width="550" cellpadding="10" cellspacing="0" border="0" style="border:1px solid #333;background:#ffffff;"><tr><td>'.
				'<p>name: '.
        $_POST["name"].
        '</p><p>number: '.
        $_POST["phone"].
        '</p><p>message: '.
        $_POST["message"].
        '</p>'.
        '</td></tr></table>'.
        '</td></tr></table></body></html>';

$mail->AltBody = $_POST["name"]." ".$_POST["phone"]." ".$_POST["message"];
 
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
 
if(!$mail->send()) {
   echo '<div class="block-out"><h3>Woops</h3>!<p class="send-error">Something went wrong, please try again later or email me <a href="mailto:dst.germain48@gmail.com">directly</a>.</p></div>';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo('<div class="block-out"><p class="send-success"><h3>Thanks!</h3><p>'.$_POST["name"].', your message successfully sent!</p></div>');
?>