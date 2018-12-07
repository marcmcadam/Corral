<?php
session_start();
REQUIRE('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Class List";
require "../PAGES/HEADER_PUBLIC.PHP";


?>

<h2 style="margin-left: 35%;">Class List</h2>
<form name="classlist" action="ClassList.php" method="post">
<!--	Unit Instance ID: <input type="text" name="Unit_ID" maxlength="14"id="ip2" required><br><br>
-->
	<table>
			<tr valign='top'>
					<td> Student List:
						</td>
					<td><textarea rows="25" cols="75" name="Student_List" required></textarea>
						</td>
			</tr>
			<tr>
					<td></td>
					<td><input type="submit" name="Submit" value="Submit">
							<input type="reset" value="Clear Form"></td>
			</tr>
	</table>
</form>


<?php
//----------------------------------------
//|         FUNCTIONS                    |
//----------------------------------------
/*if(!isset($CON)){
	print "CON not set <br><br>";
	include('../DATABASE/CONNECTDB.PHP');
} else {
	print "CON is set <br><br>";
}*/
function SanitiseGeneric($input, $CON){
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  return $input;
}
function SanitiseString($input, $CON){
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  return $input;
}
function SanitiseName($input, $CON){
  $input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  $input = ucfirst($input);
  return $input;
}


//If the form has been submitted explodes based upon \r giving each student's
//		info as a single piece in an array
		//variable name hierarchy
		 	//$student_List -list of all students in csv
			//$StudentArr		-Each student is an entity in the array
			//$student is the instance of the $StudentArr
			//$stu_info is the exploded information of the student
			//accessing $stu_info[] to access the information
if( isset( $_POST['Submit'] ) ) {
	$Student_List = $_POST['Student_List'];
	print "Raw Data: ". $Student_List."<br><br> Other Stuff: <br>";

//NB explode could be replaced by fgetcsv()
	$StudentArr = explode("\r", $Student_List);

	foreach ($StudentArr as $student){
		$student = trim($student);
		print "Student Details: ".$student."<br>";

		$stu_info = explode (",",$student);

		print "Stu ID: ".$stu_info[0]."<br>";

		//[0] = Student ID
		$stu_ID = SanitiseGeneric($stu_info[0], $CON);
		//Validate student id is only numbers

		if($stu_ID != 0 || $stu_ID != NULL){
			//SQL check if Student exists
			$query = "SELECT stu_ID FROM student WHERE stu_ID = '".$stu_info[0]."'";
			$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
			//if they do, break
			if(mysqli_num_rows($result) > 0){
				//do nothing
			} else {
			//if not then

				//[1] = First name
				$stu_FirstName = SanitiseName($stu_info[1], $CON);
				//[2] = last Name
				$stu_LastName = SanitiseName($stu_info[2], $CON);
				//[3] = Campus
				$stu_Campus = SanitiseGeneric($stu_info[3], $CON);
				//[4] = email
				$stu_Email = SanitiseString($stu_info[4], $CON);
				//[5] = password
					//NB this is not meant to be encrypted at all.
						//it is meant to be impossible for the encryption produced in
						//the login form to match with the string saved here
				$stu_Password = SanitiseString($stu_info[5], $CON);
				//[6] =  locked out
				$stu_LockedOut = SanitiseGeneric($stu_info[6], $CON);
				//[7] = login attmepts
				$stu_loginAttempts = SanitiseGeneric($stu_info[7], $CON);

				//VALIDATE THEM HERE

				//add to
				$insert_query =
					"INSERT INTO student
							(stu_ID, stu_FirstName, stu_LastName, stu_Campus,
								stu_Email, stu_Password, stu_LockedOut, stu_LoginAttempts  )
						VALUES
							('".$stu_ID."', '".$stu_FirstName."', '".$stu_LastName."', '".$stu_Campus."',
								'".$stu_Email."', '".$stu_Password."', '".$stu_LockedOut."', '".$stu_loginAttempts."')";


				$insert_SQL = mysqli_query($CON, $insert_query) or die(mysqli_error($CON));

				//DEBUG
				print"<b>".$stu_FirstName." "."$stu_LastName"."</b> was added to the DB<br><br>";
			}
		}else {
			print "Student ID of '0' was detected";
		}
	}

}



?>
<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
