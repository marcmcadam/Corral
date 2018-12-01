<?php
 	$PageTitle = "Staff Update";
	require "HEADER_STAFF.PHP";
?>
<div id="contents">

  <h2>Updated staff information</h2>
	<?php
 require("../DATABASE/CONNECTDB.php");


		$number=$_POST['STAFF_ID'];
		$firstname=$_POST['STAFF_FIRSTNAME'];
		$lastname=$_POST['STAFF_LASTNAME'];
		$location=$_POST['STAFF_LOCATION'];
		$email=$_POST['STAFF_EMAIL'];

		if(empty($location)){
				echo "<p>you need to input location</p>";
			}else if(empty($email)){
				echo "<p>You need to input email</p>";
			}else if(empty($firstname)){
				echo "<p>You need to input firstname</p>";
			}else if(empty($lastname)){
				echo "<p>You need to input lastname</p>";
			}else{



	        $sql="UPDATE STAFF SET STAFF_LOCATION='$location',STAFF_EMAIL='$email',STAFF_FIRSTNAME='$firstname',STAFF_LASTNAME='$lastname' WHERE STAFF_ID=$number";

	        $b=mysqli_query($CON,$sql);

	         if(!$b){
	                echo "<p>Failed to update information</p>";
	          }else{
	                if(mysqli_affected_rows($CON)>0){
	                    echo "<p>Information successfully updated</p>";
	                    echo "<p><a href='STAFFLIST.PHP'>Back to staff list</a></p>";
	                }else{
	                    return "<p>Rows not affected</p>";
	                }
	            }

	        mysqli_close($CON);
	    }

	?>


<hr>

<?php require "FOOTER_STAFF.PHP"; ?>
