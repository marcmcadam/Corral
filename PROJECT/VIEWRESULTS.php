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

<h2>Results</h2>

<?php
require('../DATABASE/CONNECTDB.PHP');

	$sql="SELECT * FROM PROJECT WHERE PROJECT_STATUS='".$View."'";
	if ($View == "All") {
		$sql="SELECT * FROM PROJECT";
	}

    $res=mysqli_query($CON, $sql);
    echo "<p><table width='900px'  border='1px' cellpadding='10px'></p>";
    echo "<tr><th>Project Number</th><th>Project Brief</th><th>Project Leader</th><th>Project Status</th></tr>";
    while ($row=mysqli_fetch_assoc($res)){
        echo "<tr><td align='center'>{$row['PROJECT_NUM']}</td><td align='center'>{$row['PROJECT_BRIEF']}</td><td align='center'>{$row['PROJECT_LEADER']}</td><td align='center'>{$row['PROJECT_STATUS']}</td></tr>";
    }
    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);
?>

<br><hr>

Export Project CSV:
<form action="../PROJECT/PROJECTLISTCSV" method="post">
	<select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select><br>
	<input type="submit" name="export_excel" value="CSV">
</form>

<br>

Export Project PDF:
<form action="../PROJECT/PROJECTLISTPDF" method="post">
 <select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select><br>
	<input type="submit" name="export_PDF" value="PDF">
</form>
<br>
<a href="../PROJECT/PROJECTSEARCH">Back to Project Search</a>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
</body>
</html>
