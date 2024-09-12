<?php
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors', 1);


//https://accounts.google.com/b/0/DisplayUnlockCaptcha - Account access enabled
//https://www.google.com/settings/u/1/security/lesssecureapps - Authorized less secured apps
//https://security.google.com/settings/security/activity?hl=en&pli=1

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
*/

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

function sendEmail($name, $receiver, $subject, $cc, $bcc, $message, $html_email, $attachments, $save_mail) {

//global $logo;
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$SITE_MASTER_FOLDER = explode(DIRECTORY_SEPARATOR, dirname(__DIR__));
$SITE_MASTER_FOLDER = end($SITE_MASTER_FOLDER);

//Create a new PHPMailer instance
$mail = new PHPMailer();
//global $mail;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;//SMTP::DEBUG_SERVER

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'fittain804@gmail.com';//fittain804@gmail.com

//Password to use for SMTP authentication
$mail->Password = 'auctione12';//auctione12

//Set who the message is to be sent from
//$mail->setFrom('garagepoortenmaxam.nl@gmail.com', 'Maxam');
$mail->setFrom("fittain804@gmail.com", "Community Manager - Notification");

//Set an alternative reply-to address
//$mail->addReplyTo('garagepoortenmaxam.nl@gmail.com', 'Maxam');
$mail->addReplyTo("fittain804@gmail.com", "Community Manager - Notification");
//

$mail->addAddress($receiver, $name);

/*
//Set who the message is to be sent to
$mail->addAddress('thebusinessdrive@gmail.com', 'Ahmad Bashir');
$mail->addCC('petertough4@gmail.com');
$mail->addCC('info@xantros.nl');
$mail->addBCC('xantros@gmail.com');
*/
foreach ($cc as $key => $value) {
	if ( filter_var($value, FILTER_VALIDATE_EMAIL) ) {
		$mail->addCC($value);
	}
}
foreach ($bcc as $key => $value) {
	if ( filter_var($value, FILTER_VALIDATE_EMAIL) ) {
		$mail->addBCC($value);
	}
}
/*

if(filter_var($email, FILTER_VALIDATE_EMAIL))
{
    list($userName, $mailDomain) = explode("@", $email);
    if (!checkdnsrr($mailDomain, "MX"))
    {
        // Email is unreachable.
    }
}
else
{
    // Email is bad.
}

*/

//$pdf_file = $doc_root.DIRECTORY_SEPARATOR."quote".DIRECTORY_SEPARATOR."invoice_pdf".DIRECTORY_SEPARATOR."2021-BE-5072-O.pdf";

// Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment("$pdf_file", '2021-BE-5072-O.pdf');    // Optional name

foreach ($attachments as $key => $value) {
	$mail->addAttachment("$value");
}

//$config_email_signature = EMAILSIGNATURE;

//images to be used
//$logo = $doc_root.DIRECTORY_SEPARATOR."quote".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."header.png";
//$email_signature = $doc_root.DIRECTORY_SEPARATOR."quote".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."email_signature.jpg";
//$email_signature = $doc_root.DIRECTORY_SEPARATOR."quote".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."$config_email_signature";

//Attach an image file
//$mail->addAttachment($logo);
//$mail->addEmbeddedImage($logo, 'logoimg', 'header.png');// attach file logo.jpg, and later link to it using identfier logoimg
//$mail->addEmbeddedImage($email_signature, 'emailsignatureimg', 'email_signature.jpg');// attach file logo.jpg, and later link to it using identfier logoimg

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->Body    = "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
  <title>Community Manager</title>
</head>
<body>
<div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;'>
  <p style='color:#2a2828;'>$html_email</p>

<div align='left'>

</div><br>
</div>
</body>
</html>";

//Replace the plain text body with one created manually
$mail->AltBody = $message;

//send the message, check for errors

if(!$mail->send()) {
	$err = "Mailer Error: " . $mail->ErrorInfo;
	//log_error("/n $err ");
	$msg = "<div id='barepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
	opacity: 1;'>&times;</button><img src='images/failed.png' /><strong>Oops! </strong> Message could not be sent. ($err) </div>";
	$res = array("status"=>"FAILED","data"=>"$msg");
}else{
	$msg = "<div id='gorepor' class='alert-dismissable'><button type='button' class='close pushleft' data-dismiss='alert' aria-hidden='true' style='color: #fff !important;
	opacity: 1;'>&times;</button><img src='images/goodfb.png' /> <strong>Thanks! </strong> Your message has been received, we will get back to you shortly. </div>";
	$res = array("status"=>"OK","data"=>"$msg");

	if ($save_mail === true) {
    	//Section 2: IMAP
		//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
		//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
		//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
		//be useful if you are trying to get this working on a non-Gmail IMAP server.
	    //You can change 'Sent Mail' to any other folder or tag
	    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

	    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
	    $imapStream = imap_open($path, $mail->Username, $mail->Password);

	    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
	    imap_close($imapStream);

	    //return $result;
    }

}
return $res;
}
?>