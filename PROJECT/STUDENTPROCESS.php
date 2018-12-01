<?php
 	$PageTitle = "Template";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents">

  <h2>Updated student information</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");


		$number=$_POST['STUDENT_ID'];
		$firstname=$_POST['STUDENT_FIRSTNAME'];
		$lastname=$_POST['STUDENT_LASTNAME'];
		$location=$_POST['STUDENT_LOCATION'];
		$email=$_POST['STUDENT_EMAIL'];


	     if(empty($location)){
	        echo "<p>You need to input location</p>";
	    }else if(empty($email)){
			 echo "<p>You need to input email</p>";
		}else if(empty($firstname)){
			 echo "<p>You need to input firstname</p>";
		}else if(empty($lastname)){
			 echo "<p>You need to input lastname</p>";
		}else{



	        $sql="UPDATE STUDENT SET STUDENT_LOCATION='$location',STUDENT_EMAIL='$email',STUDENT_FIRSTNAME='$firstname',STUDENT_LASTNAME='$lastname' WHERE STUDENT_ID=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update information</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Information successfully updated</p>";
	                    echo "<p><a href='STUDENTLIST.PHP'>Back to student list</a></p>";
	                }else{
	                    return "<p>Rows not affected</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
