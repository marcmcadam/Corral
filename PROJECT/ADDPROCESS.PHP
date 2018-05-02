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
	</div>
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
</div>



<div id="contents">

  <h2>Update Project</h2>
<?php

   $title=$_POST['title'];

   $brief=$_POST['brief'];

   $leader=$_POST['leader'];

   $email=$_POST['email'];

   $status="current";

   if(empty($brief)){

       echo "<p>you need to input project brief</p>";

   }else{

       REQUIRE('../DATABASE/CONNECTDB.PHP');

       mysqli_select_db($conn, 'CORRAL_PROJECT');

       $sql="insert into project (PROJECT_TITLE,PROJECT_BRIEF,PROJECT_LEADER, PROJECT_EMAIL, PROJECT_STATUS) values('$title','$brief','$leader', '$email', '$status')";

       $b=mysqli_query($conn,$sql);

        if(!$b){

               echo "<p>fail</p>";

         }else{

               if(mysqli_affected_rows($conn)>0){

                   echo "<p>success</p>";

               }else{

                   return "<p>not affected rows</p>";

               }

           }

       mysqli_close($conn);

   }

?>



</div>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
