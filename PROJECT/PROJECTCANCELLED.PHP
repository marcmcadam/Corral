<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Current Project List</title>

<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">

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

<h2>Current Project List</h2>
<?php

    $conn=mysqli_connect("localhost","root","") or die(mysqli_errno($conn));
    mysqli_select_db($conn, "test");

    $sql="select * from project where PROJECT_STATUS='Active'";
    $res=mysqli_query($conn, $sql);

    echo "<p><table width='900px'  border='1px' cellpadding='10px'></p>";
    echo "<tr><th>Project Number</th><th>Project Brief</th><th>Project Status</th></tr>";

    while ($row=mysqli_fetch_assoc($res)){
        echo "<tr><td align='center'>{$row['PROJECT_NUM']}</td><td align='center'>{$row['PROJECT_BRIEF']}</td><td align='center'>{$row['PROJECT_STATUS']}</td></tr>";
    }

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($conn);

?>
</div>
</br>
<form action="addPro.php" method="post">
<p><input type="submit" value="add project"></p>
</form>
<hr>


<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
