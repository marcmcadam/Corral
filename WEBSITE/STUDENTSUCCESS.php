<?php
session_start();
if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error.php");
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
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$id = $_POST['id'];
$email = $_POST['email'];
$question = $_POST['question'];
if(empty($firstname)||empty($lastmame)||empty($email))
{
    echo "Your Name and Email Address are Mandatory"
    exit;
}
$email_from = 'thecorralproject@gmail.com'; //our group email Address//
$email_subject = "New Question Form";
$email_body = "You have received a new question from the user $firstname $lastname. \n".
    "email address: $email\n".
    "The Message is:\n $question".
$to = "thecorralproject@gmail.com";
$headers = "From: $email_from \r\n";
mail($to,$email_subject,$email_body,$headers);
 ?>
 <div class="Header">

 	<h1>Corral Project</h1>

 </div>



<<div class="navbar">
	<a href="../PAGES/STUDENTHOME.php">Home</a>
	<a href="../SURVEY/SURVEYANSWERS.php">Survey</a>
	<a href="../PAGES/STUDENTCONTACT.php">Contacts</a>
	<a href="../PAGES/STUDENTABOUTUS.php">About Us</a>
	<a href="../Access/LOGOUT.php">Logout</a>
</div>

<div id="contents">
<h2>Question Succesfully Submitted!</h2>
<p>Thank you for your feedback! We at the Corral Project love to hear from those who use and value our website. We will reply to your comments as swiftly as possible.
<a href="../PAGES/STUDENTHOME.html"><h2 align="center">Back to Home Page</h2></a>
<div class="Footer">
	<h4>This is copy righted by Deakin and the project group 29</h4>
</div>
</body>