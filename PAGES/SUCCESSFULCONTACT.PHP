<?php
if(!isset($_POST['submit']))


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$id = $_POST['id'];
$email = $_POST['email'];
$question = $_POST['question'];

if(empty($firstname)||empty($lastname)||empty($email))
{
    echo "Your Name and Email Address are Mandatory";
    exit;
}

$email_from = 'thecorralproject@gmail.com'; //our group email Address//
$email_subject = "New Question Form";
$email_body = "You have received a new question from the user $firstname $lastname. \n".
    "email address: $email\n".
    "The Message is:\n $question".

$to = "thecorralproject@gmail.com";
$headers = "From: $email_from \r\n";
$headers = "Reply-To: $email \r\n";

@mail($to,$email_subject,$email_body,$headers);
 ?>

<html>
<head>
<meta charset="utf-8">
<title>Thank You!</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>
<body>

 <div class="Header">

 

 </div>



<div class="navbar">
	<a href="../PAGES/HOME.html">Home</a>
	<a href="../PAGES/REGISTER.html">Projects</a>
	<a href="../PAGES/CONTACT.html">Contacts</a>
	<a href="../PAGES/ABOUTUS.html">About Us</a>
	<div class="dropdown">
		<button class="dropbtn">Login
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="../Acess/login.php">Students</a>
			<a href="../ACCESS/stafflogin.php">Staff</a>
		</div>
	</div>
</div>

<div id="contents">
<h2>Question Succesfully Submitted!</h2>
<p>Thank you for your feedback! We at Corral love to hear from those who use and value our website. We will reply to your comments as swiftly as possible.</p>
<a href="../PAGES/HOME.html"><h2 align="center">Back to Home Page</h2></a>
<div class="Footer">
	<h4>This is copy righted by Deakin and the project group 29</h4>
</div>
</body>
</html>
