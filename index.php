<?php

include 'class.phpmailer.php';
include 'class.smtp.php';

$smtp_host	= 'mail.domain.com';
$smtp_k_adi	= 'mail@domain.com'; /*mail username, email@domain.com*/
$smtp_sifre	= '123456'; /*password*/

$smtp_dizi = array(
	'varsayilan'=>'local', /* default -> local server mail service (alternative : gmail, live, yandex, amazon) any standard service can be added as new line or remove */
	'local'	=>array('port'=>587,'from'=>false,'host'=>$smtp_host, 'k_adi'=>$smtp_k_adi, 'sifre'=>$smtp_sifre),
	'gmail'	=>array('port'=>587,'from'=>false,'host'=>'smtp.gmail.com', 'k_adi'=>'username@gmail.com', 'sifre'=>'password'),
	'live'	=>array('port'=>587,'from'=>false,'host'=>'smtp.live.com', 'k_adi'=>'username@outlook.com.tr', 'sifre'=>'password'),
	'yandex'=>array('port'=>587,'from'=>false,'host'=>'smtp.yandex.com', 'k_adi'=>'username@yandex.com', 'sifre'=>'password'),
	'amazon'=>array('port'=>587,'from'=>$smtp_k_adi,'host'=>'email-smtp.us-east-1.amazonaws.com', 'k_adi'=>'AKIAQAZQA2DCFVCTJTOH', 'sifre'=>'BOHcoIdqm2OzhFtsFigWAWGrar2jW3cHMKaeoa8YgirX')
);

$phpmailer = new phpmailer_mail($smtp_dizi, 1);
/*end of config*/

$body = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>New mail</title></head><body><div>Hello. New mail!</div></body></html>';
$altmail = 'Hello. New mail!';
$subject = 'New Mail!';
$to = array('email1@gmail.com','email2@gmail.com');
$phpmailer->gonder($to, $subject, $body, $smtp_k_adi, 'bcc', $altmail);

	if ($phpmailer->gonderildi) {
		echo 'Mail Sent';
	}

$body2 = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>New mail</title></head><body><div>Hello. New mail!</div></body></html>';
$subject2 = 'New Mail!';
$to2 = array('email1@gmail.com','email2@gmail.com');
$phpmailer->gonder($to2, $subject2, $body2, $smtp_k_adi);

?>
