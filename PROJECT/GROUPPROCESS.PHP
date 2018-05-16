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

<title>Template</title>
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

  <h2>Project Added</h2>
	<?PHP
	REQUIRE('../DATABASE/CONNECTDB.PHP');
	    // IF THE VALUES ARE POSTED, (CREATED BY MARC) INSERT THEM INTO THE DATABASE.
	{

		GROUPS_NUM INT NOT NULL AUTO_INCREMENT,
		PROJECT_TITLE VARCHAR(25) NOT NULL,
		STUDENT_ID INT NOT NULL,
		GROUPS_COUNT INT NOT NULL,

	  $PROJECTTITLE = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_TITLE']);
		$STUDENTID = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_LEADER']);
		$GROUP_COUNT = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_EMAIL']);
		$PROJECTSTATUS = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_STATUS']);

	  $QUERY = "INSERT INTO PROJECT (PROJECT_TITLE, PROJECT_LEADER, PROJECT_EMAIL, PROJECT_BRIEF, PROJECT_STATUS)
					   VALUES ('$PROJECTTITLE', '$PROJECTLEADER', '$PROJECTEMAIL', '$PROJECTBRIEF', '$PROJECTSTATUS')";

	        $RESULT = MYSQLI_QUERY($CON, $QUERY);
	        IF($RESULT){
	            $SMSG = "PROJECT CREATED SUCCESSFULLY.";
	        }ELSE{
	            $FMSG ="PROJECT CREATION FAILED";

	        }
	    }

	    ?>



</div>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
