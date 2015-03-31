<?php

class sendMail{

  	public $mailOption;

  	public function options($mailOption){

  		include("vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

		/* Account SMTP Host */
		$mailOption['host'] = 'host';
		$mailOption['port'] = 'porta';
		$mailOption['user'] = 'usuario';
		$mailOption['pass'] = 'senha';

		/* Send developer mail */
		$mailOption['dev'] = 'Email do dev';
		$mailOption["client"] = 'Nome de cliente';
		$mailOption['business'] = 'Nome de empresa';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $mailOption['host'];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $mailOption['user'];                 // SMTP username
		$mail->Password = $mailOption['pass'];                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $mailOption['port'];                                    // TCP port to connect to

		$mail->From = 'mysql@example.com';
		$mail->FromName = $mailOption["client"];
		$mail->addAddress($mailOption['dev'], $mailOption['business']);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $mailOption['return'];
		$mail->Body    = $mailOption['content'];
		$mail->AltBody = $mailOption['content'];


		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		    die();
		} else {
		    echo 'Message has been sent';
		    die();
		}
	}
}