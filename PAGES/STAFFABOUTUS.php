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
<html>
<head>
<meta charset="utf-8">
<title>About Us</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
</head>

<body>
<div class="Header">
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
  <h2>About Us</h2>
<p>Welcome to the Corral 'about us' page. Here you will find details of how this project began along with some frequently asked questions as listed below:</p>

</div>

<hr>
<h2>Origins of Corral</h2>
<p>The Corral was created for the SIT374 'Project Design' unit at Deakin University, whereby we were required to create a prototype that serves as a solution to the pre-existing problem of sorting individuals into equal groups based on skill.</p>

<hr>
<h2>Frequently Asked Questions</h2>
<h3>How does it work?</h3>
<p>The process begins with users completing our quick survey, detailing their skills on both a technical and personal level. From there, the survey is submitted and added to our databases. From there your job as the user is done! When new projects are added, users can then be allocated certain roles, which is dependant on not only the users proficiency in certain skills, but also the skills required for the task at hand. Once the team has been finalised, users may access details of the project and contact other members of the group.</p>
<h3>Who can use Corral?</h3>
<p>Corral has been primarily designed for students and teachers as an interface for sharing upcoming projects that students will take part in. However, Corral can also be utilised by employers who desire a platform for showcase upcoming projects that require group work, as Corral takes away the pain and time of assigning equal teams to different tasks. </p>
<h3>User Guide</h3>
<p>If you wish to read a simple guide<a href="../DOCUMENTATION/UserGuide-Staff.pdf">, please click here</a></p>

<div class="Footer">
	© Copyright Deakin University & Group 29 2018
</div>
</body>
</html>
