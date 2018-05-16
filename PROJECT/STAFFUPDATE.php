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

$_SESSION['number']=$_GET['number'];

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
<h2>Update Staff List</h2>
<p><form action="../PROJECT/STAFFPROCESS" method="post"></p>
<p>Staff number <?php echo $_GET['number'];?></p>

<p>Firstname </p>
<p><input type="text" name="STAFF_FIRSTNAME" value="<?php echo $_GET['firstname'];?>" id="ip2"/></p>
<p>Lastname </p>
<p><input type="text" name="STAFF_LASTNAME" value="<?php echo $_GET['lastname'];?>" id="ip2"/></p>
<p>Location </p>
<p><input type="text" name="STAFF_LOCATION" value="<?php echo $_GET['location'];?>" id="ip2"/></p>
<p>Email </p>
<p><input type="text" name="STAFF_EMAIL" value="<?php echo $_GET['email'];?>" id="ip2"/></p>

<p><input type="submit" value="update">&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>



<hr>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
