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

<title>Staff Update</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">

</head>



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
<h2>Update Staff List</h2>
<p><form action="../PROJECT/STAFFPROCESS" method="post"></p>


<p>Staff ID </p>
<p><input type="text" name="STAFF_ID" value="<?php echo $_GET['number'];?>" id="ip2"/></p>
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
