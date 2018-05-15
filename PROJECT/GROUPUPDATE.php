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



<div id="contents">  <h2>Update Project</h2>

<?php

   $number=$_REQUEST['number'];

   $brief=$_POST['brief'];

   $status=$_POST['status'];

   if(empty($brief)){

       echo "<p>you need to input project brief</p>";

   }else{        required('../DATABASE/CONNECTDB.php');

       mysqli_select_db($conn, "test");        $sql="update project set PROJECT_BRIEF='$brief',PROJECT_STATUS='$status' where PROJECT_NUM=$number";        $b=mysqli_query($conn,$sql);         if(!$b){

               echo "<p>fail</p>";

         }else{

               if(mysqli_affected_rows($conn)>0){

                   echo "<p>success</p>";

                   echo "<p><a href='proList.php'>back to project list</a></p>";

               }else{

                   return "<p>not affected rows</p>";

               }

           }



       mysqli_close($conn);

   }?></div>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
