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

<title>Update Project</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">

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


<div id="contents" >
<h2>Update Project</h2>
<p>Project Number </p>
<p><form action="../PROJECT/updateProcess.php" method="post"></p>
<p><input type="text" name="PROJECT_NUM"/></p>
<p>Project Brief </p>
<p><textarea name="PROJECT_BRIEF" rows="5" cols="40"></textarea></br></p>
<p>Project Status &nbsp</br></br><input type="radio" name="PROJECT_STATUS" value="active"/>Active</br></br><input type="radio" name="PROJECT_STATUS" value="inactive"/>Inactive</br></br><input type="radio" name="PROJECT_STATUS" value="planning"/>Planning</br></br>
<input type="radio" name="PROJECT_STATUS" value="cancelled"/>Cancelled</br></p>
<p><input type="submit" value="update">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>

<hr>
<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
