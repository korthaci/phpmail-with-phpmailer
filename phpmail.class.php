<?php

class phpmailer_mail {
private $smtp_dizi; /* array()*/
private $server;
private $smtp_debug;
public $gonderildi; /*if sent success true*/

	function __construct ($smtp_dizi,$smtp_debug=0){
	$this->smtp_dizi = $smtp_dizi;
	$this->server = ($smtp_dizi['varsayilan']==false) ? 'local' : $smtp_dizi['varsayilan'];
	$this->smtp_debug = $smtp_debug;
	}

	function gonder($to=array(), $subject, $body , $reply, $bcc='bcc', $textMessage='') {
	$this->gonderildi = false;
	$mail = new PHPMailer(true);
	$subject_domain = strtoupper(preg_replace('/([a-z0-9]+)\.([^\.]+)\.([a-z0-9]+)$/i','$2',$_SERVER['SERVER_NAME']));
	$set_from_mail = $this->smtp_dizi[$this->server]['from']===false ? $this->smtp_dizi[$this->server]['k_adi'] : $this->smtp_dizi[$this->server]['from'];

		try {
		$mail->Port = $this->smtp_dizi[$this->server]['port'];
		$mail->SMTPSecure = ($this->smtp_dizi[$this->server]['port']==587) ? 'tls' : 'ssl';
		$mail->Encoding = 'quoted-printable';
		$mail->SMTPDebug=0;
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->isHTML(true);
		$mail->SMTPDebug = $this->smtp_debug;

		$mail->Host = $this->smtp_dizi[$this->server]['host'];
		$mail->Username = $this->smtp_dizi[$this->server]['k_adi'];
		$mail->Password = $this->smtp_dizi[$this->server]['sifre'];

		$mail->SMTPKeepAlive = true;
		$mail->SMTPOptions = array('ssl' => array('verify_peer' => true,'verify_peer_name' => false,'allow_self_signed' => false));

		$mail->SetFrom($set_from_mail, $subject_domain);
		/*$mail->ClearReplyTos();*/
		$mail->AddReplyTo($reply, $subject_domain);

			foreach ($to as $to0) {
				if (filter_var(trim($to0), FILTER_VALIDATE_EMAIL)) {
				$mail->AddAddress($to0, $subject_domain.' u.');
				}
			}
	
			if ($bcc=='bcc') { $mail->AddBCC("korthaci1@gmail.com", $subject.' BCC');}/*for check mail success, add 'bcc' */

		$mail->Subject = $subject;

		$mail->MsgHTML($body);
		$mail->AltBody = $textMessage;

		$this->gonderildi = ($mail->Send());
	
		} catch (phpmailerException $e) {
			echo "<span style=\"font-size:10px;\">Bir hata oluştu. {$e->errorMessage()}</span>", PHP_EOL; /*Catch errors from PHPMailer.*/
		} catch (Exception $e) {
			echo "<span style=\"font-size:10px;\">Email gönderilemedi. {$mail->ErrorInfo}</span>", PHP_EOL; /*Catch errors from mail service.*/
		}
	}
}
?>
