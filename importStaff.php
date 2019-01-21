<?php
require_once "connectdb.php";
$PageTitle = "Import Staff";
require "header_staff.php";
require_once "sanitise.php";
?>

<h2 class="main">Import Staff from CSV</h2>
<p> Please attach the .csv file, you may download the sample data csv to use as a template.</p>
<form name="classlist" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
	<table align="center">
			<tr valign='top'>
					<td> Staff List:
					</td>

					<td><input type="file" name="csvFile"></td>
					<td align='right'><input type="submit" name="Submit" value="Submit" class="inputButton">
							<input type="reset" value="Clear Form" class="inputButton">
							<a href="./Sample_StaffCSV_File.php"><input type="button" name="GetSample" value="Sample Data" class="inputButton" ></a>
					</td>

			</tr>
	</table>
</form>
<br>


<?php


//If the form has been submitted explodes based upon \r giving each staff's
//		info as a single piece in an array
		//variable name hierarchy
		 	//$staff_List -list of all staffs in csv
			//$staffArr		-Each staff is an entity in the array
			//$staff is the instance of the $staffArr
			//$sta_info is the exploded information of the staff
			//accessing $sta_info[] to access the information
if( isset( $_POST['Submit'] ) ) {

	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES["csvFile"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($imageFileType == "csv"){
		$staff_List = file_get_contents( $_FILES['csvFile']['tmp_name'] );
	} else if ($imageFileType != "csv" && $imageFileType != NULL){
		print "Import failed: Only CSV files can be uploaded, please check your file extension.<br>";
		$staff_List ="";
	} else {
		print "Import failed: No imported information detected. <br>";
		$staff_List ="";
	}

//DEBUG
//	print "Raw Data: ". $staff_List."<br><br> Other staff: <br>";

//NB explode could be replaced by fgetcsv()
	$staffArr = explode("\n", $staff_List);

	foreach ($staffArr as $staff){
	//	print "<span style='color:blue' >staff Details:</span> ".$staff."<br>";

		$sta_info = explode (",",$staff);

//	print "sta ID: ".$sta_info[0]."<br>";

		//[0] = First name
		$sta_FirstName = SanitiseInput($sta_info[0], $CON);

		//Validate staff id is only numbers
	 	if( $sta_FirstName != "" && $sta_FirstName != " " && $sta_FirstName != "FirstName") {


			//[1] = last Name
			$sta_LastName = SanitiseInput($sta_info[1], $CON);
			//[2] = Campus
			$sta_Campus = SanitiseInput($sta_info[2], $CON);
			//[3] = email
			$sta_Email_caps = SanitiseInput($sta_info[3], $CON);
			$sta_Email = strtolower($sta_Email_caps);

			//password
				//NB this is not meant to be encrypted at all.
					//it is meant to be impossible for the encryption produced in
					//the login form to match with the string saved here
			$sta_Password = "NoneSet";
			//locked out
			$sta_LockedOut = "0";
			//login attmepts
			$sta_loginAttempts = "5";


			//Validation
			if(!preg_match('/[1-3]{1}/', $sta_Campus) ){
				print "<span style='color:red' >Import failed: ERROR in sta_Campus: $sta_Campus </span><br>";
				$Validation = 0;
			} else {
				if(!preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $sta_Email) ){
					print "<span style='color:red' >Import failed: ERROR in sta_Email: $sta_Email </span> <br>";
					$Validation = 0;
				} else {
					$Validation = 1;
				}
			}


			if ($Validation == 0){

				print "Import failed, failed validation of data for Staff: ".$sta_FirstName."<br>";

			} else {
				//SQL check if staff exists
				$query = "SELECT sta_ID FROM staff WHERE sta_email = '".$sta_Email."'";
				$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
				//if they do, update
				if(mysqli_num_rows($result) > 0){
					//update
					$Update_query =
						"UPDATE staff SET
								sta_FirstName = '".$sta_FirstName."',
								sta_LastName = '".$sta_LastName."',
								sta_Campus = '".$sta_Campus."',
								sta_Password = '".$sta_Password."',
								sta_LockedOut = '".$sta_LockedOut."',
								sta_LoginAttempts =  '".$sta_loginAttempts."'
							WHERE
								sta_email = '".$sta_Email."'";


					$Update_SQL = mysqli_query($CON, $Update_query) or die(mysqli_error($CON));
					//DEBUG
					//	echo $insert_query."<br>";
					//report line
					print "<b>Duplicate</b> found for <b>".$sta_FirstName." "."$sta_LastName"."</b>, updating the DB with the new information<br><br>";

				} else {
					//if not then INSERT
					$insert_query =
						"INSERT INTO staff
								(sta_FirstName, sta_LastName, sta_Campus,
									sta_Email, sta_Password, sta_LockedOut, sta_LoginAttempts  )
							VALUES
								('".$sta_FirstName."', '".$sta_LastName."', '".$sta_Campus."',
									'".$sta_Email."', '".$sta_Password."', '".$sta_LockedOut."', '".$sta_loginAttempts."')";


					$insert_SQL = mysqli_query($CON, $insert_query) or die(mysqli_error($CON));

					//DEBUG
				//	echo $insert_query."<br>";
				//	print"<b>".$sta_FirstName." "."$sta_LastName"."</b> was added to the DB<br><br>";
				}
				print "Import Successful<br>";


			}

		} else if($sta_FirstName == "" || $sta_FirstName == " " || $sta_FirstName == "FirstName"){
			// DEBUG
			//print "staff number is blank <br>";
		} else {
			print "Staff number must contain only nine numbers, for: ".$sta_FirstName.",<br>";
		}

	}
}



require "footer.php"; ?>
