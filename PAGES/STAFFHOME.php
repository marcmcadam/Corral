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
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
<style>
/*Picture wont float right?*/
#stockpic
{
    float:right;
}
</style>
</head>

<body>
<div class="Header">
	<h1>The Corral Project</h1>
</div>

<div class="navbar">
	<a href="../PAGES/STAFFHOME.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Projects
			<i class="fa fa-caret-down"></i>
		</button>
        	<div class="dropdown-content">
            		<a href="../PROJECT/ADDPROJECT.php">Create a Project</a>
            		<a href="../PROJECT/NEWGROUP.php">Make Groups</a>
            		<a href="../PROJECT/GROUPLIST.php">Group List</a>
            		<a href="../PROJECT/PROJECTLIST.php">Previous Projects</a>
			<a href="../PROJECT/updatePro.php">Update Projects</a>
		</div>
	</div>
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
</div>
<div id="contents">
	<h2>Welcome to the Corral Project</h2>
<p>This site aims to provide staff and students with a platform to view and request access to upcoming projects. Through this platform, staff and teachers may upload projects for students, including details of the skills sets and numbers required for the job. Students who register can then complete a quick survey to determine their levels or proficency in certain areas such as IT and communication. The Corral Project takes this information, and provides Teachers with a list of suitable candidates for the positions available.


  <br><br>For more information, please click <a href="STAFFABOUTUS.PHP">here</a></p>

  </div>
</div>

<hr>
<p>&nbsp;</p>

<div class="Footer">
	<h4>This is copyrighted by Deakin and the project group 29</h4>
</div>
</body>
</html>
