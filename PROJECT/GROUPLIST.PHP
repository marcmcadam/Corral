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

<title>Project List</title>
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
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
</div>



<div id="contents" >

<h2>Group List</h2>
<?php

    require('../DATABASE/CONNECTDB.PHP');
    mysqli_select_db($conn, 'CORRAL_PROJECT');

    $sql="select * from project";
    $res=mysqli_query($conn, $sql);

    echo "<p><table width='400px' border='1px'></p>";
    echo "<tr><th>Group Number</th><th>Group Title</th><th>Group Leader</th><th>Leader Email</th><th>Project Brief</th><th>Project Status</th></tr>";

    while ($row=mysqli_fetch_assoc($res)){
        echo "<tr><td>{$row['PROJECT_NUM']}</td><td>{$row['PROJECT_TITLE']}</td><<td>{$row['PROJECT_LEADER']}</td><td>{$row['PROJECT_EMAIL']}</td><td>{$row['PROJECT_BRIEF']}</td><td>{$row['PROJECT_STATUS']}</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($conn);

?>
</div>


<hr>


<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
