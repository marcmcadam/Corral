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

<title>Template</title>
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
						<li><a href ="../PROJECT/PROJECTLIST">List Projects</a></li>
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
<h2>Update Project</h2>
<p><form action="../PROJECT/PROJECTPROCESS" method="post"></p>
<p>Project Number </p>
<p><input type="number" name="PROJECT_NUM" value="<?php echo $_GET['number'];?>" id="ip2"/></p>
<p>Project Title </p>
<p><input type="text" name="PROJECT_TITLE" value="<?php echo $_GET['title'];?>" id="ip2"/></p>
<p>Project Leader </p>
<p><input type="text" name="PROJECT_LEADER" value="<?php echo $_GET['leader'];?>" id="ip2"/></p>
<p>Leader Email </p>
<p><input type="email" name="PROJECT_EMAIL" value="<?php echo $_GET['email'];?>" id="ip2"/></p>
<p>Project Brief </p>
<p><textarea name="PROJECT_BRIEF" rows="5" cols="40" value="<?php echo $_GET['brief'];?>" id="ip3"></textarea></br></p>
<p>Project Status &nbsp</br></br><input type="radio" name="PROJECT_STATUS" value="active"/>Active</br></br><input type="radio" name="PROJECT_STATUS" value="inactive"/>Inactive</br></br><input type="radio" name="PROJECT_STATUS" value="planning"/>Planning</br></br>
<input type="radio" name="PROJECT_STATUS" value="cancelled"/>Cancelled</br></p>
<p><input type="submit" value="update">&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>


<hr>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
