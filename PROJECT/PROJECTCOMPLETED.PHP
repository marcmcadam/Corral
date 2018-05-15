<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Current Project List</title>

<style>

body {

  padding-bottom: 40px;

  background-color: #eee;

}

.form-signin {

  max-width: 330px;

  padding: 15px;

  margin: 0 auto;

}

.form-signin .form-signin-heading,

.form-signin .checkbox {

  margin-bottom: 10px;

}

.form-signin .checkbox {

  font-weight: normal;

}

.form-signin .form-control {

  position: relative;

  height: auto;

  -webkit-box-sizing: border-box;

     -moz-box-sizing: border-box;

          box-sizing: border-box;

  padding: 10px;

  font-size: 16px;

}

.form-signin .form-control:focus {

  z-index: 2;

}

.form-signin input[type="email"] {

  margin-bottom: -1px;

  border-bottom-right-radius: 0;

  border-bottom-left-radius: 0;

}

.form-signin input[type="password"] {

  margin-bottom: 10px;

  border-top-left-radius: 0;

  border-top-right-radius: 0;

}

.Header {

	background-color: #333;

	font-family: Arial, Helvetica, sans-serif;

	color: white;

	text-align: center;

	padding: 5px;

}

.Footer {

	padding: 20px;

	background-color: #333;

	color: white;

	text-align: center;

	font-family: Arial, Helvetica, sans-serif;

}

p {

	margin-left: 40px;

	margin-right: 50px;

	font-family: Arial, Helvetica, sans-serif;

}

h2 {

	margin-left: 40px;

	font-family: Arial, Helvetica, sans-serif;

}

/* The navagation bar for the site, linked to the drop downs */

	.navbar {

    overflow: hidden;

    background-color: #333;

    font-family: Arial, Helvetica, sans-serif;

}

.navbar a {

    float: left;

    font-size: 16px;

    color: white;

    text-align: center;

    padding: 14px 100px;

    text-decoration: none;

}

/* This is for the drop down in the navigation bar */

.dropdown {

    float: left;

    overflow: hidden;

}

.dropdown .dropbtn {

    font-size: 16px;

    border: none;

    outline: none;

    color: white;

    padding: 14px 16px;

    background-color: inherit;

    font-family: inherit;

    margin: 0;

}

.navbar a:hover, .dropdown:hover .dropbtn {

    background-color: red;

}

.dropdown-content {

    display: none;

    position: absolute;

    background-color: #f9f9f9;

    min-width: 160px;

    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

    z-index: 1;

}

.dropdown-content a {

    float: none;

    color: black;

    padding: 12px 16px;

    text-decoration: none;

    display: block;

    text-align: left;

}

.dropdown-content a:hover {

    background-color: #ddd;

}

.dropdown:hover .dropdown-content {

    display: block;

}

/*Picture wont float right?*/

#stockpic

{

    float:right;

}

</style>

</head>



<body>

<div class="Header">



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
