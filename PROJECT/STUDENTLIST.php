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

<title>Student List</title>
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


<div id="contents" >

<h2>Student Information</h2>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM student ORDER BY STUDENT_ID ASC";
$res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>LOCATION</th><th>EMAIL</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "<tr><td align='center' width='70px'>{$row['STUDENT_ID']}</td><td align='center' width='190px'>{$row['STUDENT_FIRSTNAME']}</td><td align='center' width='190px'>{$row['STUDENT_LASTNAME']}</td><td align='center' width='180px'>{$row['STUDENT_LOCATION']}</td><td align='center'  width='500px'>{$row['STUDENT_EMAIL']}</td><td align='center'><a href='STUDENTUPDATE.php?number={$row['STUDENT_ID']}&firstname={$row['STUDENT_FIRSTNAME']}&lastname={$row['STUDENT_LASTNAME']}&location={$row['STUDENT_LOCATION']}&email={$row['STUDENT_EMAIL']}'>Update</a></td></tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>


<hr>


<form action="../PROJECT/STUDENTCSV" method="post">
	<input type="submit" name="STUDENT_CSV" value="Export Student List To CSV">
</form>

<p>

<form action="../SURVEY/SURVEYCSV" method="post">
	<input type="submit" name="SURVEY_CSV" value="Export Student Survey To CSV">
</form>


<br>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
