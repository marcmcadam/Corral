<?php
require_once "connectdb.php";
$PageTitle = "Class List";
require "header_staff.php";
?>

<h2 class="main">Class List</h2>
<form name="classlist" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
	<table align="center">
			<tr valign='top'>
					<td> Student List:
						</td>
			</tr>
			<tr>
					<td></td>
					<td><input type="file" name="csvFile"></td>
					<td align='right'><input type="submit" name="Submit" value="Submit" class="inputButton">
							<input type="reset" value="Clear Form" class="inputButton">
							</td>
			</tr>
	</table>
</form>


<?php
//----------------------------------------
//|         FUNCTIONS                    |
//----------------------------------------
/*if(!isset($CON)){
	print "CON not set <br><br>";
	include('connectdb.php');
} else {
	print "CON is set <br><br>";
}*/
function SanitiseGeneric($input, $CON){
	$input = preg_replace("/[']+/", "", $input);
	$input = preg_replace("/[,]+/", "", $input);
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  return $input;
}
function SanitiseEmail($input, $CON){
	$input = preg_replace("/[']+/", "", $input);
	$input = preg_replace("/[,]+/", "", $input);
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  return $input;
}
function SanitiseName($input, $CON){
	$input = preg_replace("/[^a-zA-Z]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  return $input;
}


		//move_uploaded_file($_FILES["csvFile"]["tmp_name"], $target_file);
//If the form has been submitted explodes based upon \r giving each student's
//		info as a single piece in an array
		//variable name hierarchy
		 	//$student_List -list of all students in csv
			//$StudentArr		-Each student is an entity in the array
			//$student is the instance of the $StudentArr
			//$stu_info is the exploded information of the student
			//accessing $stu_info[] to access the information
if( isset( $_POST['Submit'] ) ) {
	if(isset($_POST['Student_List']) && $_POST['Student_List'] != NULL){
		$Student_List = $_POST['Student_List'];
	} else /*if (isset($_POST['csvFile'])) */{
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["csvFile"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if($imageFileType == "csv"){
			$Student_List = file_get_contents( $_FILES['csvFile']['tmp_name'] );
		} else {
			print "Only CSV files can be uploaded, please check your file extension.<br>";
			$Student_List ="";
		}
	}
//DEBUG
//	print "Raw Data: ". $Student_List."<br><br> Other Stuff: <br>";

//NB explode could be replaced by fgetcsv()
	$StudentArr = explode("\r", $Student_List);

	foreach ($StudentArr as $student){
		$student = trim($student);
		print "<span style='color:blue' >Student Details:</span> ".$student."<br>";

		$stu_info = explode (",",$student);

		print "Stu ID: ".$stu_info[0]."<br>";

		//[0] = Student ID
		$stu_ID = SanitiseGeneric($stu_info[0], $CON);
		//Validate student id is only numbers
	 	if(preg_match('/[0-9]{9}/', $stu_ID) ){

			//[1] = First name
			$stu_FirstName = SanitiseName($stu_info[1], $CON);
			//[2] = last Name
			$stu_LastName = SanitiseName($stu_info[2], $CON);
			//[3] = Campus
			$stu_Campus = SanitiseGeneric($stu_info[3], $CON);
			//[4] = email
			$stu_Email = SanitiseEmail($stu_info[4], $CON);
			//password
				//NB this is not meant to be encrypted at all.
					//it is meant to be impossible for the encryption produced in
					//the login form to match with the string saved here
			$stu_Password = "NoneSet";
			//locked out
			$stu_LockedOut = "1";
			//login attmepts
			$stu_loginAttempts = "5";


			//Validation
			if(!preg_match('/[1-3]{1}/', $stu_Campus) ){
				print "<span style='color:red' >ERROR in stu_Campus: $stu_Campus </span><br>";
				$Validation = 0;
			} else {
				if(!preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $stu_Email) ){
					print "<span style='color:red' >ERROR in stu_Email: $stu_Email </span> <br>";
					$Validation = 0;
				} else {
					$Validation = 1;
				}
			}


			if ($Validation == 0){
				print "<span style='color:red' >An error occured, see error list above.</span><br><br>";
			} else {
				//SQL check if Student exists
				$query = "SELECT stu_ID FROM student WHERE stu_ID = '".$stu_info[0]."'";
				$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
				//if they do, break
				if(mysqli_num_rows($result) > 0){
					//update
					$insert_query =
						"UPDATE student SET
								stu_FirstName = '".$stu_FirstName."',
								stu_LastName = '".$stu_LastName."',
								stu_Campus = '".$stu_Campus."',
								stu_Email = '".$stu_Email."',
								stu_Password = '".$stu_Password."',
								stu_LockedOut = '".$stu_LockedOut."',
								stu_LoginAttempts =  '".$stu_loginAttempts."'
							WHERE
								stu_ID	= '".$stu_ID."' ";


					$insert_SQL = mysqli_query($CON, $insert_query) or die(mysqli_error($CON));

					//DEBUG
					echo $insert_query."<br>";
					//report line
					print "<b>Duplicate</b> found for ID: ".$stu_ID." <b>".$stu_FirstName." "."$stu_LastName"."</b>, updateding the DB with the new information<br><br>";
				} else {
					//if not then
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
					echo $insert_query."<br>";
					print"<b>".$stu_FirstName." "."$stu_LastName"."</b> was added to the DB<br><br>";
				}
			}

		} else {
			print "Student number must contain only nine numbers, for: ".$stu_ID.",<br>";
		}

	}
}


?>
<?php require "footer.php"; ?>
