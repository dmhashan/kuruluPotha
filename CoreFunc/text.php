<?php

$email=$_POST['email'];

require_once('./php/tool/PHPMailer-master/PHPMailerAutoload.php');
//PHPMailer Object
$mail = new PHPMailer;
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "kurulupotha@gmail.com";
$mail->Password = "CST140014";
$mail->SetFrom("admin@kurulupotha.com");
$mail->FromName = "Kurulu Potha";

//To address and name
$mail->addAddress("dmhashan@gmail.com");
//$mail->addAddress("recepient1@example.com"); //Recipient name is optional
//Address to which recipient will reply
$mail->addReplyTo("kurulupotha@gmail.com", "Reply");

//CC and BCC
//$mail->addCC("CC");
//$mail->addCC("CC");
//$mail->addBCC("bcc@example.com");
//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "User verification link for Kurulu Potha E-Guidance system";
$mail->Body = "";
//$mail->AltBody = "This is the plain text version of the email content";

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;

    //echo 'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>';
} else {
    //echo "Message has been sent successfully";
    echo 'Successfully Applied for vacancy';

    //echo "<script type='text/javascript'>alert('Successfully Applied for vacancy');</script>";
    //header("Location: vacancy.php");
}

//**end of send e-mail**
?>