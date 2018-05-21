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
<title>Results</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesstaff.css">
</head>

<body>
<?php
//defining the values
$View = $_POST['View'];

?>
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

<h2>Results</h2>

<?php
    $CON=mysqli_connect("localhost","root","") or die(mysqli_errno($CON));
    mysqli_select_db($CON, "corral_project");

	$sql="select * from project where PROJECT_STATUS='".$View."'";
	if ($View == "All") {
		$sql="select * from project";
	}

    $res=mysqli_query($CON, $sql);
    echo "<p><table width='900px'  border='1px' cellpadding='10px'></p>";
    echo "<tr><th>Project Number</th><th>Project Brief</th><th>Project Status</th></tr>";
    while ($row=mysqli_fetch_assoc($res)){
        echo "<tr><td align='center'>{$row['PROJECT_NUM']}</td><td align='center'>{$row['PROJECT_BRIEF']}</td><td align='center'>{$row['PROJECT_STATUS']}</td></tr>";
    }
    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);
?>

<br><hr>
<p><a href="../PROJECT/PROJECTSEARCH">Back to Project Search</a></p>
<form action="../PROJECT/EXCEL" method="post">
	<input type="submit" name="export_excel" value="Export to Excel">
</form>

<form action="../PROJECT/PDF" method="post">
	<input type="submit" name="export_PDF" value="Export to PDF">
</form>

<div class="Footer">
	<h4>This is copy righted by Deakin and the project group 29</h4>
</div>
</body>
</html>
