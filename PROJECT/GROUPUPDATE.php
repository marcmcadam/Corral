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
						<li><a href ="../PROJECT/updatePro">Update Project</a></li>
						<li><a href ="../PROJECT/PROJECTLIST.php">List Projects</a></li>
						<li><a href ="PROJECTSEARCH">Project Search</a></li>
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

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
