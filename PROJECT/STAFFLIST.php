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
	<a href="../PAGES/STAFFHOME.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Projects
			<i class="fa fa-caret-down"></i>
		</button>
        	<div class="dropdown-content">
            		<a href="../PROJECT/ADDPROJECT.php">Create Project</a>
								<a href="../PROJECT/PROJECTLIST.php">Project List</a>
								<a href="../PROJECT/PROJECTUPDATE.PHP">Update Project</a>
            		<a href="../PROJECT/ADDGROUP.php">Create Group</a>
            		<a href="../PROJECT/GROUPLIST.php">Group List</a>
								<a href="../PROJECT/GROUPUPDATE.PHP">Update Group</a>
                 <a href="../PROJECT/STUDENTLIST.php">Student List</a>
					<a href="../PROJECT/STAFFLIST.php">Staff List</a>
							</div>
	</div>
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
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
    echo "<tr><td align='center' width='70px'>{$row['STAFF_ID']}</td><td align='center' width='190px'>{$row['STAFF_FIRSTNAME']}</td><td align='center' width='190px'>{$row['STAFF_LASTNAME']}</td><td align='center' width='180px'>{$row['STAFF_LOCATION']}</td><td align='center'  width='500px'>{$row['STAFF_EMAIL']}</td><td align='center'><a href='STAFFUPDATE.php?number={$row['STAFF_NUM']}&firstname={$row['STAFF_FIRSTNAME']}&lastname={$row['STAFF_LASTNAME']}&location={$row['STAFF_LOCATION']}&email={$row['STAFF_EMAIL']}'>Update</a></td></tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>


<hr>


<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
