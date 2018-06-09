<?php
session_start();
if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STUDENT_ID'];
	$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
	$student_lastname = $_SESSION['STUDENT_LASTNAME'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thank You!</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>
<body>
<?php
require '../PHPMailer/PHPMailerAutoload.php';

//Contact Us Form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//Gmail Configuration
$mail = new PHPMailer;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'thecorralproject@gmail.com';    // SMTP username
$mail->Password = 'corral374'; 						// SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom($name);
$mail->addReplyTo($email);
$mail->addAddress('thecorralproject@gmail.com');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

//Email body contents

$bodyContent = '<h2>Corral Contact Us</h2>' . '<br>'. '<br>';
$bodyContent .= $message . '<br>'. '<br>';
$bodyContent .= $name . '<br>';
$bodyContent .= $email . '<br>';
//Email subject
$mail->Subject = 'Contact Us -';
$mail->Subject .= $subject;
//Email body
$mail->Body=$bodyContent;
//Confirm message is sent or not
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
}
 ?>
 <div class="Header">

</div>



<div class="navbar">
	<a href="../PAGES/STUDENTHOME">Home</a>
	<a href="../SURVEY/STUDENTSURVEY">Survey</a>
	<a href="../PAGES/STUDENTCONTACT">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS">About Us</a>
	<a href="../Access/LOGOUT">Logout</a>
</div>

<div id="contents">
<h2>Question Succesfully Submitted!</h2>
<p>Thank you for your feedback! We at Corral love to hear from those who use and value our website. We will reply to your comments as swiftly as possible.
<a href="../PAGES/STUDENTHOME"><h2 align="center">Back to Home Page</h2></a>
<div class="Footer">
	© Copyright Deakin University & Group 29 2018
</div>
</body>
