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

<title>Project List</title>
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

<h2>Project List</h2>
<?php

    require('../DATABASE/CONNECTDB.PHP');




    $sql="SELECT * FROM PROJECT ORDER BY PROJECT_STATUS ASC";
    $res=mysqli_query($CON, $sql);

    echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
    echo "<tr><th>Project Num</th><th>Project Title</th><th>Project Leader</th><th>Leader Email</th><th>Project Brief</th><th>Project Status</th><th>Update Information</th></tr>";

		while ($row=mysqli_fetch_assoc($res)){
		    echo "<tr><td align='center' width='70px'>{$row['PROJECT_NUM']}</td><td align='center' width='190px'>{$row['PROJECT_TITLE']}</td><td align='center' width='190px'>{$row['PROJECT_LEADER']}</td><td align='center' width='180px'>{$row['PROJECT_EMAIL']}</td><td align='center' width='500px'>{$row['PROJECT_BRIEF']}</td><td align='center'  width='180px'>{$row['PROJECT_STATUS']}</td><td align='center'><a href='PROJECTUPDATE.php?number={$row['PROJECT_NUM']}&title={$row['PROJECT_TITLE']}&leader={$row['PROJECT_LEADER']}&email={$row['PROJECT_EMAIL']}&brief={$row['PROJECT_BRIEF']}&status={$row['PROJECT_STATUS']}'>Update</a></td></tr>";
		}



    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);





?>
</div>


<hr>
<br>


<form action="../PROJECT/PROJECTLISTCSV" method="post">
<select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select>
	<input type="submit" name="export_excel" value="Export As CSV">
</form>

<br>

<form action="../PROJECT/PROJECTLISTPDF" method="post">
	<select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select>
	<input type="submit" name="export_PDF" value="Export As PDF">
</form>

<br>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
