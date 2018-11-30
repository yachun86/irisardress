<?php
	include("./phpmailer/class.phpmailer.php");

	$mail             = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "yachun86@gmail.com";  // GMAIL username
	$mail->Password   = "yachun86";            // GMAIL password

	$mail->From       = "yachun86@gmail.com";
	$mail->Subject    = "PHPMailer Test Subject via gmail";
	$mail->Body       = "Hi, this is a test";           
	$mail->AddAddress("yachun86@gmail.com", "Hussain");

	$mail->send();


?>