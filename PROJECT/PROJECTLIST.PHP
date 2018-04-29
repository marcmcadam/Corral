<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Project List</title>
<link rel="stylesheet" type="text/css" href="STYLES/stylesheet.css">
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

	<a href="#Home">Home</a>

	<a href="#Projects">Projects</a>

	<a href="#Conatacts">Contacts</a>

	<a href="#About Us">About Us</a>

	<div class="dropdown">

		<button class="dropbtn">Login

			<i class="fa fa-caret-down"></i>

		</button>

		<div class="dropdown-content">

			<a href="#Students">Students</a>

			<a href="#Teachers">Teachers</a>

		</div>

	</div>

</div>



<div id="contents" >

<h2>Project List</h2>
<?php

    $conn=mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1') or die(mysqli_errno($conn));
    mysqli_select_db($conn, 'CORRAL_PROJECT');

    $sql="select * from project";
    $res=mysqli_query($conn, $sql);

    echo "<p><table width='400px' border='1px'></p>";
    echo "<tr><th>Project Number</th><th>Project Title</th><th>Project Leader</th><th>Leader Email</th><th>Project Brief</th><th>Project Status</th></tr>";

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
