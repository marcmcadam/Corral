<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You must log in before viewing this page";
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



<div id="contents">

  <h2>Project Added</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");

	    $number=$_REQUEST['PROJECT_NUM'];
			$title=$_POST['PROJECT_TITLE'];
			$leader=$_POST['PROJECT_LEADER'];
			$email=$_POST['PROJECT_EMAIL'];
	    $brief=$_POST['PROJECT_BRIEF'];
	    $status=$_POST['PROJECT_STATUS'];





	    if(empty($brief)){
	        echo "<p>you need to input project brief</p>";
	    }else{



	        $sql="UPDATE PROJECT SET PROJECT_TITLE='$title', PROJECT_LEADER='$leader', PROJECT_EMAIL='$email', PROJECT_BRIEF='$brief',PROJECT_STATUS='$status' WHERE PROJECT_NUM=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update project</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Project successfully updated</p>";
	                    echo "<p><a href='PROJECTLIST.PHP'>Back to project list</a></p>";
	                }else{
	                    return "<p>not affected rows</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
