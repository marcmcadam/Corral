<?php
 	$PageTitle = "Template";
	require "header_staff.php";
?>
<div id="contents">

  <h2>Updated student information</h2>
	<?php
 require("connectdb.php");


		$number=$_POST['stu_ID'];
		$firstname=$_POST['stu_FirstName'];
		$lastname=$_POST['stu_LastName'];
		$location=$_POST['stu_Campus'];
		$email=$_POST['stu_Email'];


	     if(empty($location)){
	        echo "<p>You need to input location</p>";
	    }else if(empty($email)){
			 echo "<p>You need to input email</p>";
		}else if(empty($firstname)){
			 echo "<p>You need to input firstname</p>";
		}else if(empty($lastname)){
			 echo "<p>You need to input lastname</p>";
		}else{



	        $sql="UPDATE student SET stu_Campus='$location',stu_Email='$email',stu_FirstName='$firstname',stu_LastName='$lastname' WHERE stu_ID=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update information</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Information successfully updated</p>";
	                    echo "<p><a href='studentlist.php'>Back to student list</a></p>";
	                }else{
	                    return "<p>Rows not affected</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<?php require "footer_staff.php"; ?>
