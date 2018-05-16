<?php
session_start();
if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/error");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
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
	<h1>Corral</h1>
</div>



<div class="navbar">
		<a href="../PAGES/STAFFHOME">Home</a>
		<div class="dropdown">
			<button class="dropbtn">Projects
				<i class="fa fa-caret-down"></i>
			</button>
	        	<div class="dropdown-content">
	            		<a href="../PROJECT/ADDPROJECT">Create Project</a>
				<a href="../PROJECT/PROJECTLIST">Project List</a>
				<a href="../PROJECT/PROJECTUPDATE">Update Project</a>
	            		<a href="../PROJECT/ADDGROUP">Create Group</a>
	            		<a href="../PROJECT/GROUPLIST">Group List</a>
				<a href="../PROJECT/GROUPUPDATE">Update Group</a>
	                	<a href="../PROJECT/STUDENTLIST">Student List</a>
	                	<a href="../PROJECT/STAFFLIST">Staff List</a>
			</div>
		</div>
		<a href="../PAGES/STAFFCONTACT">Contacts</a>
		<a href="../PAGES/STAFFABOUTUS">About Us</a>
		<a href="../ACCESS/stafflogout">Logout</a>
</div>

<div id="contents">
<h2>Question Succesfully Submitted!</h2>
<p>Thank you for your feedback! We at Corral love to hear from those who use and value our website. We will reply to your comments as swiftly as possible.
<a href="../PAGES/STAFFHOME"><h2 align="center">Back to Home Page</h2></a>
<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
