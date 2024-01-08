<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function send_mail(array $mail_settings, array $to, string $subject, string $body, array $attachments= [])
{
	$mail = new PHPMailer(); 
	try {
		$mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = $mail_settings['host'];                     
    $mail->SMTPAuth   = $mail_settings['auth'];                                   
    $mail->Username   = $mail_settings['username'];                     
    $mail->Password   = $mail_settings['password'];                               
    $mail->SMTPSecure = $mail_settings['secure'];            
    $mail->Port       = $mail_settings['port']; 
		$mail->CharSet = $mail_settings['charset'];

		$mail->setFrom($mail_settings['from_email'], $mail_settings['from_name']);
		foreach($to as $email) {
			$mail->addAddress($email);
		}
		

		$mail -> Subject = $subject;

		$mail -> msgHTML($body);
		if ($mail->send()) {
		
		//send the message, check for errors
	echo "<h1 class=\"recovery-message\">Сообщение отправлено на вашу электронную почту.Пожалуйста прочитайте его.</h1>";
		} else {
			echo $mail->ErrorInfo;
		}
	} 
	catch (Exception $e) {
		echo "Message couldn't be sent.Mailer Error: {$mail->ErrorInfo}";
}
}