<?php 

include_once 'core/classes/PHPMailer/PHPMailerAutoload.php';

function fcEmail($subject, $html, $text, $recipients)
{
	GLOBAL $confMailFromAdresse, $confMailFromName, $confMailReplytoAdresse, $confMailReplytoName;
	
	$email = new PHPMailer;
	$email->CharSet = 'utf-8';
	$email->From = $confMailFromAdresse;
	$email->FromName = $confMailFromName;
	$email->addReplyTo($confMailReplytoAdresse, $confMailReplytoName);

	$email->isHTML($confMailSendhtml);

	//Empfängeradressen einfügen
	$keys = array_keys($recipients);
	foreach($keys as $key) 
	{
		$email->addAddress($key, $recipients[$key]);
	}

	$email->Subject = $subject;
	$email->Body    = $html;
	$email->AltBody = $text;
	
	return $email->send();
}

?>