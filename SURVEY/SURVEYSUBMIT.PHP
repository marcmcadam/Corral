<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!doctype html>
<?PHP
REQUIRE('../DATABASE/CONNECTDB.PHP');

{

  $STUDENT_ID = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_ID']);
	$STUDENT_EMAIL = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_EMAIL']);
	$STUDENT_FIRSTNAME = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_FIRSTNAME']);
	$STUDENT_LASTNAME = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['STUDENT_LASTNAME']);
  $LOCATION = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['LOCATION']);
  $CURRENT_COURSE = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['CURRENT_COURSE']);
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

  $QUERY = "INSERT INTO SURVEYANSWER (STUDENT_ID, STUDENT_EMAIL, STUDENT_FIRSTNAME, STUDENT_LASTNAME, LOCATION, CURRENT_COURSE, TECHNICAL_SKILLS1, TECHNICAL_SKILLS2, TECHNICAL_SKILLS3, TECHNICAL_RATING1, TECHNICAL_RATING2, TECHNICAL_RATING3, SOFT_SKILLS1, SOFT_SKILLS2, SOFT_SKILLS3, SOFT_RATING1, SOFT_RATING2, SOFT_RATING3)
				   VALUES ('$STUDENT_ID', '$STUDENT_EMAIL', '$STUDENT_FIRSTNAME', '$STUDENT_LASTNAME', '$LOCATION', '$CURRENT_COURSE', '$TECHNICAL_SKILLS1', '$TECHNICAL_SKILLS2', '$TECHNICAL_SKILLS3', '$TECHNICAL_RATING1', '$TECHNICAL_RATING2', '$TECHNICAL_RATING3', '$SOFT_SKILLS1', '$SOFT_SKILLS2', '$SOFT_SKILLS3', '$SOFT_RATING1', '$SOFT_RATING2', '$SOFT_RATING3')";

        $RESULT = MYSQLI_QUERY($CON, $QUERY);
        IF($RESULT){
            $SMSG = "SURVEYANSWER CREATED SUCCESSFULLY.";
        }ELSE{
            $FMSG ="SURVEYANSWER CREATION FAILED";

        }
    }

    ?>

<HTML>
   <BODY>
	  <DIV ID="MIDDLE">
				<H1> SURVEY RESULTS </H1>
				<TABLE>
						<TR>
							<TD>STUDENT ID: </TD>
							<TD> <?PHP ECHO $STUDENT_ID?> </TD>
						</TR>
						<TR>
							<TD>EMAIL: </TD>
							<TD> <?PHP ECHO $STUDENT_EMAIL?> </TD>
						</TR>
						<TR>
							<TD>FIRST NAME: </TD>
							<TD> <?PHP ECHO $STUDENT_FIRSTNAME?> </TD>
						</TR>
						<TR>
							<TD>LAST NAME: </TD>
							<TD> <?PHP ECHO $STUDENT_LASTNAME?> </TD>
						</TR>
            <TR>
							<TD>LOCATION: </TD>
							<TD> <?PHP ECHO $LOCATION?> </TD>
						</TR>
            <TR>
							<TD>CURRENT COURSE: </TD>
							<TD> <?PHP ECHO $CURRENT_COURSE?> </TD>
						</TR>
            <TR>
              <TD>TECHNICAL SKILLS1: </TD>
              <TD> <?PHP ECHO $TECHNICAL_SKILLS1?> </TD>
            </TR>
            <TR>
							<TD>TECHNICAL SKILLS2: </TD>
							<TD> <?PHP ECHO $TECHNICAL_SKILLS2?> </TD>
						</TR>
            <TR>
							<TD>TECHNICAL SKILLS3:  </TD>
							<TD> <?PHP ECHO $TECHNICAL_SKILLS3?> </TD>
						</TR>
            <TR>
              <TD>TECHNICAL RATING1:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING1?> </TD>
            </TR>
            <TR>
              <TD>TECHNICAL RATING2:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING2?> </TD>
            </TR>
            <TR>
              <TD>TECHNICAL RATING3:  </TD>
              <TD> <?PHP ECHO $TECHNICAL_RATING3?> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS1: </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS1?> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS2: </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS2?> </TD>
            </TR>
            <TR>
            <TD>SOFT SKILLS3:  </TD>
            <TD> <?PHP ECHO $SOFT_SKILLS3?> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING1:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING1?> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING2:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING2?> </TD>
            </TR>
            <TR>
              <TD>SOFT RATING3:  </TD>
              <TD> <?PHP ECHO $SOFT_RATING3?> </TD>
            </TR>


					</TABLE>
	  </DIV>
   </BODY>
</HTML>
