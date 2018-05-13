<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error.php");
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
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>

<body>
<div class="Header">
	<h1>Corral Project</h1>
</div>

<div class="navbar">
	<a href="../PAGES/STAFFHOME.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Projects
			<i class="fa fa-caret-down"></i>
		</button>
        	<div class="dropdown-content">
            		<a href="../PROJECT/ADDPROJECT.php">Create Project</a>
								<a href="../PROJECT/PROJECTLIST.php">Project List</a>
								<a href="../PROJECT/PROJECTUPDATE.PHP">Update Project</a>
            		<a href="../PROJECT/ADDGROUP.php">Create Group</a>
            		<a href="../PROJECT/GROUPLIST.php">Group List</a>
								<a href="../PROJECT/GROUPUPDATE.PHP">Update Group</a>
                <a href="../PROJECT/STUDENTLIST.php">Student List</a>
                <a href="../PROJECT/STAFFLIST.php">Staff List</a>
							</div>
	</div>
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
</div>

<div id="contents">
<h2>Contact Us</h2>
<p>Although the Corral Project is designed to make communcation between team members and employers/teachers more efficient when dealing with group projects, we understand that some individuals might still want some questions answered. If you do have any questions, please first check out our 'About Us' page as we do have a frequently asked questions section.

<hr>
<h2>Tell Us What You Think!</h2>
<p>Do you have a question that we didn't talk about in our FAQ section or would you like to give us some feedback? Insert your details below and we will get back to you as soon as possible!
<form style="margin-left: 40px" name="emailcontact" onSubmit="return validate(emailcontact)" method="post" action="../PAGES/STAFFSUCCESS.php">
	First Name: <input type="text" name="firstname" id="ip2" required><br><br>
	Last Name: <input type="text" name="lastname" id="ip2" required><br><br>
	Student ID: <input type="text" name="id" maxlength="9" id="ip2" required><br><br>
	Email Address: <input type="text" name="email" size="40" id="ip2" required><br><br>
  Question: <input type="text" name="question" size="40" id="ip2" required><br><br>

		<input type="submit" name="Submit" value="Submit">
		<input type="reset" value="Clear Form"><br><br>
</form>

<div class="Footer">
	<h4>This is copy righted by Deakin and the project group 29</h4>
</div>
</body>
