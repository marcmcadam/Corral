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

<title>Staff List</title>
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

<h2>Staff Information</h2>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM STAFF ORDER BY STAFF_ID ASC";
$res=mysqli_query($CON, $sql);

echo "<p><table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'></p>";
echo "<tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>LOCATION</th><th>EMAIL</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "<tr><td align='center' width='70px'>{$row['STAFF_ID']}</td><td align='center' width='190px'>{$row['STAFF_FIRSTNAME']}</td><td align='center' width='190px'>{$row['STAFF_LASTNAME']}</td><td align='center' width='180px'>{$row['STAFF_LOCATION']}</td><td align='center'  width='500px'>{$row['STAFF_EMAIL']}</td><td align='center'><a href='STAFFUPDATE.php?number={$row['STAFF_ID']}&firstname={$row['STAFF_FIRSTNAME']}&lastname={$row['STAFF_LASTNAME']}&location={$row['STAFF_LOCATION']}&email={$row['STAFF_EMAIL']}'>Update</a></td></tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>


<hr>

<form action="../PROJECT/STAFFCSV" method="post">
	<input type="submit" name="STAFF_CSV" value="Export Staff List To CSV">
</form>

<p>

<form action="../PROJECT/STAFFPDF" method="post">
	<input type="submit" name="STAFF_PDF" value="Export Staff List to PDF">
</form>

<br>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
