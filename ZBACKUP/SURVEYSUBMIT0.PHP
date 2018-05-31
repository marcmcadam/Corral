<?php
session_start();

if ( $_SESSION['STUDENT_ID'] != 1) {
	$_SESSION['message'] = "You mus log in before viewing this page";
	header("location: ../ACCESS/error.php");
	}
	else {
	$id = $_SESSION['STUDENT_ID'];
	$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
	$student_lastname = $_SESSION['STUDENT_LASTNAME'];
	}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/stylesheet.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!doctype html>
<?PHP
REQUIRE('../DATABASE/CONNECTDB.PHP');
{
	$STUDENT_ID= MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_ID']);
  $LOCATION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['LOCATION']);
  $CURRENT_COURSE = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['CURRENT_COURSE']);
	$ROLE1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE1']);
	$ROLE2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE2']);
	$ROLE3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['ROLE3']);
  $TECHNICAL_SKILLS1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS1']);
  $TECHNICAL_SKILLS2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS2']);
  $TECHNICAL_SKILLS3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_SKILLS3']);
  $TECHNICAL_RATING1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING1']);
  $TECHNICAL_RATING2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING2']);
  $TECHNICAL_RATING3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['TECHNICAL_RATING3']);
  $SOFT_SKILLS1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS1']);
  $SOFT_SKILLS2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS2']);
  $SOFT_SKILLS3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_SKILLS3']);
  $SOFT_RATING1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING1']);
  $SOFT_RATING2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING2']);
  $SOFT_RATING3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['SOFT_RATING3']);
  $PROJECT_PREFERENCE1 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE1']);
  $PROJECT_PREFERENCE2 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE2']);
  $PROJECT_PREFERENCE3 = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_PREFERENCE3']);
  $STUDENT_PERMISSION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_PERMISSION']);
  $STUDENT_ASPIRATION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_ASPIRATION']);
  $STUDENT_COMMENT = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_COMMENT']);

  $QUERY = "INSERT INTO SURVEYANSWER (STUDENT_ID, LOCATION, CURRENT_COURSE, ROLE1, ROLE2, ROLE3, TECHNICAL_SKILLS1, TECHNICAL_SKILLS2, TECHNICAL_SKILLS3, TECHNICAL_RATING1, TECHNICAL_RATING2, TECHNICAL_RATING3, SOFT_SKILLS1, SOFT_SKILLS2, SOFT_SKILLS3, SOFT_RATING1, SOFT_RATING2, SOFT_RATING3, PROJECT_PREFERENCE1, PROJECT_PREFERENCE2, PROJECT_PREFERENCE3, STUDENT_PERMISSION, STUDENT_ASPIRATION, STUDENT_COMMENT)
            VALUES ('$STUDENT_ID', '$LOCATION', '$CURRENT_COURSE', '$ROLE1', '$ROLE2', '$ROLE3', '$TECHNICAL_SKILLS1', '$TECHNICAL_SKILLS2', '$TECHNICAL_SKILLS3', '$TECHNICAL_RATING1', '$TECHNICAL_RATING2', '$TECHNICAL_RATING3', '$SOFT_SKILLS1', '$SOFT_SKILLS2', '$SOFT_SKILLS3', '$SOFT_RATING1', '$SOFT_RATING2',
                    '$SOFT_RATING3', '$PROJECT_PREFERENCE1', '$PROJECT_PREFERENCE2', '$PROJECT_PREFERENCE3', '$STUDENT_PERMISSION', '$STUDENT_ASPIRATION', '$STUDENT_COMMENT')";

                   $RESULT = MYSQLI_QUERY($CON, $QUERY);
                   IF($RESULT){
                       $SMSG = "SURVEYANSWER CREATED SUCCESSFULLY.";
                   }ELSE{
                       $FMSG ="SURVEYANSWER CREATION FAILED";
                   }
               }
    ?>

		<html>
		<head>
		<meta charset="utf-8">
		<title>Survey Submission</title>
		<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
		</head>

		<body>
		<div class="Header">
			<h1>Corral</h1>
		</div>

		<div class="navbar">
			<a href="../PAGES/STUDENTHOME">Home</a>
			<a href="../SURVEY/STUDENTSURVEY">Survey</a>
			<a href="../PAGES/STUDENTCONTACT">Contacts</a>
			<a href="../PAGES/STUDENTABOUTUS">About Us</a>
			<a href="../Access/LOGOUT">Logout</a>
		</div>
		<div id="contents">
	  <DIV ID="MIDDLE">
				<H1> SURVEY RESULTS </H1>
				<TABLE>
					<TR>

						<TD>STUDENT ID: </TD>
						<TD> <?PHP ECHO $STUDENT_ID?> </TD>
						<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
					</TR>
            <TR>
							<TD>LOCATION: </TD>
							<TD> <?PHP ECHO $LOCATION?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
            <TR>
							<TD>CURRENT COURSE: </TD>
							<TD> <?PHP ECHO $CURRENT_COURSE?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
						<TR>
							<TD>PROGRAMMER: </TD>
							<TD> <?PHP ECHO $ROLE1?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
						<TR>
							<TD>UX/UI DESIGNER: </TD>
							<TD> <?PHP ECHO $ROLE2?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
						<TR>
							<TD>SECURITY SPECIALIST: </TD>
							<TD> <?PHP ECHO $ROLE3?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
            <TR>
              <TD>TECHNICAL SKILLS1: </TD>
              <TD> <?PHP ECHO $TECHNICAL_SKILLS1?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
							<TD>TECHNICAL SKILLS2: </TD>
							<TD> <?PHP ECHO $TECHNICAL_SKILLS2?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
            <TR>
							<TD>TECHNICAL SKILLS3:  </TD>
							<TD> <?PHP ECHO $TECHNICAL_SKILLS3?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
						</TR>
            <TR>
              <TD>TECHNICAL RATING1:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING1?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>TECHNICAL RATING2:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING2?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>TECHNICAL RATING3:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING3?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS1: </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS1?> </TD>
						<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS2: </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS2?> </TD>
						<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS3:  </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS3?> </TD>
						<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING1:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING1?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING2:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING2?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING3:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING3?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>PROJECT PREFERENCE1:   </TD>
              <TD> <?PHP ECHO $PROJECT_PREFERENCE1?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>PROJECT PREFERENCE2:   </TD>
              <TD> <?PHP ECHO $PROJECT_PREFERENCE2?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>PROJECT PREFERENCE3:  </TD>
              <TD> <?PHP ECHO $PROJECT_PREFERENCE3?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>STUDENT PERMISSION:   </TD>
              <TD> <?PHP ECHO $STUDENT_PERMISSION?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>STUDENT ASPIRATION:   </TD>
              <TD> <?PHP ECHO $STUDENT_ASPIRATION?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>
            <TR>
              <TD>STUDENT COMMENT:  </TD>
              <TD> <?PHP ECHO $STUDENT_COMMENT?> </TD>
							<TD> <a href='STUDENTUPDATE.PHP'>Update</a> </TD>
            </TR>


					</TABLE>
	  </DIV>
<br>
<a href="../Access/LOGOUT.php">All done, click here to log out</a>

<div class="Footer">
	<h4>© Copyright Deakin University & Group 29 2018</h4>
</div>
   </BODY>
</HTML>
