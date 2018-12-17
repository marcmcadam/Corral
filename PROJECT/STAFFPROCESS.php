<?php
 	$PageTitle = "Staff Update";
	require "../PAGES/HEADER_STAFF.PHP";
  require("../DATABASE/CONNECTDB.php");
?>
<div id="contents">

  <h2>Updated staff information</h2>
	<?php

   //SANITISATION FUNCTIONS
  function SanitiseGeneric($input, $CON){
    $input = mysqli_real_escape_string($CON,$input);
    //dont want commas breaking the csv output fn
    $input = preg_replace("/[,]+/", "", $input);
    $input = strip_tags($input);
    $input = trim($input);
    return $input;
  }

  function SanitiseEmail($input, $CON){
  	$input = mysqli_real_escape_string($CON,$input);
  	$input = preg_replace("/[,]+/", "", $input);
    $input = strip_tags($input);
  	$input = trim($input);
    $input = strtolower($input);
    return $input;
  }
		$number = SanitiseGeneric($_POST['STAFF_ID'], $CON);
		$firstname = SanitiseGeneric($_POST['STAFF_FIRSTNAME'], $CON);
		$lastname = SanitiseGeneric($_POST['STAFF_LASTNAME'], $CON);
		$location = SanitiseGeneric($_POST['STAFF_LOCATION'], $CON);
		$email = SanitiseString($_POST['STAFF_EMAIL'], $CON);

		if(empty($location)){
				echo "<p>you need to input location</p>";
  		}else if(empty($email)){
  			echo "<p>You need to input email</p>";
  		}else if(empty($firstname)){
  			echo "<p>You need to input firstname</p>";
  		}else if(empty($lastname)){
  			echo "<p>You need to input lastname</p>";
  		}else if(!preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $email)){
  			echo "<p>You need to input a deakin email</p>";
  		}else {



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

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
