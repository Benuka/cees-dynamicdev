<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/phpmailer/phpmailer/src/Exception.php';
require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '/vendor/phpmailer/phpmailer/src/SMTP.php';

require_once("/vendor/autoload.php");

require_once("AdminModel/mail_configuration.php");

$mail = new PHPMailer();

try {
$emailBody = "<div>" . $user["username"] . ",<br><br><p>Click this link to recover your password<br><a href='" . PROJECT_HOME . "AdminPanel/register.php?userId=" . $user["userId"] . "&username=" . $user["username"] . "&email=" . $user["email"] . "'>" . PROJECT_HOME . "AdminPanel/register.php?userId=" . $user["userId"] . "</a><br><br></p>Regards,<br> Admin.</div>";

$mail->IsSMTP();
// $mail->SMTPDebug = 1;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = PORT;  
$mail->Username = MAIL_USERNAME;
$mail->Password = MAIL_PASSWORD;
$mail->Host     = MAIL_HOST;
$mail->Mailer   = MAILER;

$mail->SetFrom(SERDER_EMAIL, SENDER_NAME);
$mail->AddReplyTo(SERDER_EMAIL, SENDER_NAME);
$mail->ReturnPath=SERDER_EMAIL;	
$mail->AddAddress($user["email"]);
$mail->addBcc("dumindu@gnexsolutions.com");
$mail->addBcc("akalanka@gnexsolutions.com");
$mail->Subject = "Forgot Password Recovery";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);
if(!$mail->Send()) {
	$error_message = 'Problem in Sending Password Recovery Email';
} else {
	$success_message = 'Please check your email to reset password!';
}
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>