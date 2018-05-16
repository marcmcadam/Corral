<?php
session_start();
if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You must log in before viewing this page";
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
		<a href="../PAGES/STAFFHOME">Home</a>
		<div class="dropdown">
			<button class="dropbtn">Projects
				<i class="fa fa-caret-down"></i>
			</button>
	        	<div class="dropdown-content">
	            		<a href="../PROJECT/ADDPROJECT">Create Project</a>
				<a href="../PROJECT/PROJECTLIST">Project List</a>
				<a href="../PROJECT/PROJECTUPDATE">Update Project</a>
	            		<a href="../PROJECT/ADDGROUP">Create Group</a>
	            		<a href="../PROJECT/GROUPLIST">Group List</a>
				<a href="../PROJECT/GROUPUPDATE">Update Group</a>
	                	<a href="../PROJECT/STUDENTLIST">Student List</a>
	                	<a href="../PROJECT/STAFFLIST">Staff List</a>
			</div>
		</div>
		<a href="../PAGES/STAFFCONTACT">Contacts</a>
		<a href="../PAGES/STAFFABOUTUS">About Us</a>
		<a href="../ACCESS/stafflogout">Logout</a>
</div>



<div id="contents">

  <h2>Updated staff information</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");


		$number=$_SESSION['number'];
		$firstname=$_POST['STAFF_FIRSTNAME'];
		$lastname=$_POST['STAFF_LASTNAME'];
		$location=$_POST['STAFF_LOCATION'];
		$email=$_POST['STAFF_EMAIL'];

		if(empty($location)){
				echo "<p>you need to input location</p>";
			}else if(empty($email)){
				echo "<p>you need to input email</p>";
			}else if(empty($firstname)){
				echo "<p>you need to input firstname</p>";
			}else if(empty($lastname)){
				echo "<p>you need to input lastname</p>";
			}else{



	        $sql="UPDATE STAFF SET STAFF_LOCATION='$location',STAFF_EMAIL='$email',STAFF_FIRSTNAME='$firstname',STAFF_LASTNAME='$lastname' WHERE STAFF_NUM=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update information</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>information successfully updated</p>";
	                    echo "<p><a href='STAFFLIST.PHP'>Back to staff list</a></p>";
	                }else{
	                    return "<p>not affected rows</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<div class="Footer">

	<h4>© Copyright Deakin University & Group 29 2018</h4>

</div>

</body>

</html>
