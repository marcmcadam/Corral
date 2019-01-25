<?php
require_once "connectdb.php";
$PageTitle = "Import Students";
require "header_staff.php";
require_once "sanitise.php";
?>

<h2 class="main">Import Students from CSV</h2>
<p> Please attach the .csv file, you may download the sample data csv to use as a template.<br>
	Students are added to <?php print  $_SESSION["unit"];?>. A different unit can be selected on the <a href="./staffhome.php">Staff Home page.</a></p>
<form name="classlist" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
	<table align="center">
			<tr valign='top'>
					<td> Student List:
					</td>

					<td><input type="file" name="csvFile"></td>
					<td align='right'><input type="submit" name="Submit" value="Submit" class="inputButton">
							<input type="reset" value="Clear Form" class="inputButton">
							<a href="./Sample_StudentCSV_File.php"><input type="button" name="GetSample" value="Sample Data" class="inputButton" ></a>
					</td>

			</tr>
	</table>
</form>
<br>


<?php


//If the form has been submitted explodes based upon \r giving each student's
//		info as a single piece in an array
		//variable name hierarchy
		 	//$student_List -list of all students in csv
			//$StudentArr		-Each student is an entity in the array
			//$student is the instance of the $StudentArr
			//$stu_info is the exploded information of the student
			//accessing $stu_info[] to access the information
if( isset( $_POST['Submit'] ) ) {

	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES["csvFile"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($imageFileType == "csv"){
		$Student_List = file_get_contents( $_FILES['csvFile']['tmp_name'] );
	} else if ($imageFileType != "csv" && $imageFileType != NULL){
		print "Import failed: Only CSV files can be uploaded, please check your file extension.<br>";
		$Student_List ="";
	} else {
		print "Import failed: No imported information detected. <br>";
		$Student_List ="";
	}

//DEBUG
//	print "Raw Data: ". $Student_List."<br><br> Other Stuff: <br>";
//successful import booleon
$succsessfulimport = 1;
//NB explode could be replaced by fgetcsv()
	$StudentArr = explode("\n", $Student_List);

	foreach ($StudentArr as $student){
	//DEBUG
	//	print "<span style='color:blue' >Student Details:</span> ".$student."<br>";

		$stu_info = explode (",",$student);

//	print "Stu ID: ".$stu_info[0]."<br>";

		//[0] = Student ID
		$stu_ID = SanitiseInput($stu_info[0], $CON);
		//Validate student id is only numbers
	 	if(preg_match('/[0-9]{9}/', $stu_ID) ){

			//[1] = First name
			$stu_FirstName = SanitiseInput($stu_info[1], $CON);
			//[2] = last Name
			$stu_LastName = SanitiseInput($stu_info[2], $CON);
			//[3] = Campus
			$stu_Campus = SanitiseInput($stu_info[3], $CON);
			//[4] = email
			$stu_Email_caps = SanitiseInput($stu_info[4], $CON);
			$stu_Email = strtolower($stu_Email_caps);

			$stu_Unit =   $_SESSION["unit"];

			//password
				//NB this is not meant to be encrypted at all.
					//it is meant to be impossible for the encryption produced in
					//the login form to match with the string saved here
			$stu_Password = "NoneSet";
			//locked out
//			$stu_LockedOut = "0";
			//login attmepts
//			$stu_loginAttempts = "5";


			//Validation
			if(!preg_match('/[1-3]{1}/', $stu_Campus) ){
				print "<span style='color:red' >Import failed: ERROR in stu_Campus: $stu_Campus </span><br>";
				$Validation = 0;
			} else {
				if(!preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $stu_Email) ){
					print "<span style='color:red' >Import failed: ERROR in stu_Email: $stu_Email </span> <br>";
					$Validation = 0;
				} else {
					$Validation = 1;
				}
			}


			if ($Validation == 0){

				print "Import failed, failed validation of data for ID: ".$stu_ID."<br>";
		    $succsessfulimport = 0;
			} else {
				//SQL check if Student exists
				$query = "SELECT stu_ID FROM student WHERE stu_ID = '".$stu_info[0]."'";
				$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
				//if they do, update
				if(mysqli_num_rows($result) > 0){
					//update
					$insert_query =
						"UPDATE student SET
								stu_FirstName = '".$stu_FirstName."',
								stu_LastName = '".$stu_LastName."',
								stu_Campus = '".$stu_Campus."',
								stu_Email = '".$stu_Email."',
								stu_Password = '".$stu_Password."'
							WHERE
								stu_ID	= '".$stu_ID."' ";


					$insert_SQL = mysqli_query($CON, $insert_query) or die(mysqli_error($CON));
					//DEBUG
					//	echo $insert_query."<br>";
					//report line
					print "<b>Duplicate</b> found for ID: ".$stu_ID." <b>".$stu_FirstName." "."$stu_LastName"."</b>, updating the DB with the new information<br><br>";

				} else {
					//if not then INSERT
					$insert_query =
						"INSERT INTO student
								(stu_ID, stu_FirstName, stu_LastName, stu_Campus,
									stu_Email, stu_Password  )
							VALUES
								('".$stu_ID."', '".$stu_FirstName."', '".$stu_LastName."', '".$stu_Campus."',
									'".$stu_Email."', '".$stu_Password."')";


					$insert_SQL = mysqli_query($CON, $insert_query) or die(mysqli_error($CON));

					//DEBUG
				//	echo $insert_query."<br>";
				//	print"<b>".$stu_FirstName." "."$stu_LastName"."</b> was added to the DB<br><br>";
				}

				/*---------------------
				//
				//		Add students to survey with unit field
				//	$stu_ID, $stu_Unit

				INSERT INTO `surveyanswer` (`stu_ID`, `unit_ID`,  `submitted`, `)
				VALUES ('$stu_ID', '$stu_Unit', '0', )
				//----------------------*/
				$UnitDupCheck_QUERY = "SELECT stu_ID FROM surveyanswer WHERE stu_ID = '".$stu_info[0]."' and unit_ID = '".$stu_Unit."'";
				$UnitDupCheck_SQL = mysqli_query($CON, $UnitDupCheck_QUERY) or die(mysqli_error($CON));
				//if they do, update
				if(mysqli_num_rows($UnitDupCheck_SQL) > 0){
					$unitQuery =
						"UPDATE surveyanswer SET
								submitted = '0'
							WHERE
								stu_ID = '".$stu_info[0]."' and
								unit_ID = '".$stu_Unit."'";
					$unit_SQL = mysqli_query($CON, $unitQuery) or die(mysqli_error($CON));
				} else {
					$unitQuery =
						"INSERT INTO surveyanswer
								(stu_ID, unit_ID,  submitted )
						VALUES ('$stu_ID', '$stu_Unit', '0' )";
					$unit_SQL = mysqli_query($CON, $unitQuery) or die(mysqli_error($CON));
				}

			}

		} else if($stu_ID == "" || $stu_ID == " " || $stu_ID == "Student ID"){
			// DEBUG
			//print "student number is blank <br>";
		} else {
			print "Student number must contain only nine numbers, for: ".$stu_ID.",<br>";
			$succsessfulimport = 0;
		}

	}
	if ($succsessfulimport == 1) {
		print "Import Successful<br>";
	} else {

	}
}



require "footer.php"; ?>
