<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
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
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
</head>

<body>
<div class="Header">
	<h1>Corral</h1>
</div>

<div class ="navbar">
	<ul>
		<li><a href="../PAGES/STAFFHOME">Home</a></li>
		<li><a href ="#">Survey</a>
			<ul>
				<li><a href ="#">Projects</a>
					<ul>
						<li><a href ="../PROJECT/ADDPROJECT">Create Project</a></li>
						<li><a href ="../PROJECT/PROJECTLIST">Project List</a></li>
						<li><a href ="../PROJECT/PROJECTSEARCH">Project Search</a></li>
					</ul>
				</li>
				<li><a href ="#">Groups</a>
					<ul>
						<li><a href ="../PROJECT/NEWGROUP">Create Group</a></li>
						<li><a href ="../PROJECT/GROUPUPDATE">Update Group</a></li>
						<li><a href ="../PROJECT/GROUPLIST">List Groups</a>
						</li>
					</ul>
				</li>
				<li><a href ="#">Users</a>
					<ul>
						<li><a href ="../PROJECT/STUDENTLIST">Student List</a></li>
						<li><a href ="../PROJECT/STAFFLIST">Staff List</a></li>
						<li><a href ="../PROJECT/MEMBERSEARCH">Search For</a></li>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href ="../PAGES/STAFFCONTACT">Contacts</a></li>
		<li><a href ="../PAGES/STAFFABOUTUS">About Us</a></li>
		<li><a href ="../ACCESS/stafflogout">Logout</a></li>
	</ul>
</div>

<div id="contents">
<h2>Contact Us</h2>
<p>Although Corral is designed to make communcation between team members and employers/teachers more efficient when dealing with group projects, we understand that some individuals might still want some questions answered. If you do have any questions, please first check out our 'About Us' page as we do have a frequently asked questions section.

<hr>
<h2>Tell Us What You Think!</h2>
<p>Do you have a question that we didn't talk about in our FAQ section or would you like to give us some feedback? Insert your details below and we will get back to you as soon as possible!</p>
<form action="../PAGES/STAFFSUCCESS" method="post">
  <p>
    <input name="name" type="text" placeholder="Please Enter Your Full Name" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <input name="email" type="email" placeholder="Please Enter Your Email Address" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <input name="subject" type="text" placeholder="Please Enter The Subject" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <textarea name="message" cols="60" rows="12" id="ip3" placeholder="Please Place Your Message Here" required="required" maxlength="600"></textarea>
  </p>
  <p>
    <input type="submit" name="SEND" id="SEND" value="SEND MESSAGE" />
  </p>
</form>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
