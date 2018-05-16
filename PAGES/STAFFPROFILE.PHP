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
<title>Welcome <?= $staff_firstname.' '.$staff_lastname ?> </title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>

<body>
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


<h2>Welcome <?= $staff_firstname. ' '.$staff_lastname?></h2>
<p>From here you can look at the project form, past projects and results for project group pairings</p>

<p>The following links below will get you to those pages:</p>
<p><ul style="list-style-type:none">
	<li><a href="../PROJECT/ADDPROJECT">Projects form</a></li>
	<li><a href="#Results">Project results</a></li>
	<li><a href="../PROJECT/PROJECTLIST">Past Projects</a></li>
</ul></p>
<p>If you wish to log out, <a href="../PAGES/STAFFLOGOUT">click here</a></p>
<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
