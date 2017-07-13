<?php

namespace HMS\Processor;
require "../../../../vendor/autoload.php";

use HMS\Database\Database as DB;
use HMS\Processor\{
	User, Time, Input
};

use PHPMailer;
class Mail{
	public static function send(String $name, String $address, String $subject, String $message){
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "garubav@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "cartographer";
//Set who the message is to be sent from
$mail->setFrom($address, 'HMS Admin');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('lemygold@gmail.com', $name);
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body = $message;


//send the message, check for errors
if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "Message sent!";
}
}
}