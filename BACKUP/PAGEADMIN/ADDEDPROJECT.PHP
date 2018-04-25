<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!doctype html>
<?PHP
REQUIRE('../DATABASE/CONNECTDB.PHP');
    // IF THE VALUES ARE POSTED, (CREATED BY MARC) INSERT THEM INTO THE DATABASE.
{

  $PROJECTNAME = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_NAME']);
	$PROJECTBRIEF = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_BRIEF']);
	$PROJECTLEADER = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_LEADER']);
	$PROJECTSTATUS = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_STATUS']);

  $QUERY = "INSERT INTO PROJECT (PROJECT_NAME, PROJECT_BRIEF, PROJECT_LEADER, PROJECT_STATUS)
				   VALUES ('$PROJECTNAME', '$PROJECTBRIEF', '$PROJECTLEADER', '$PROJECTSTATUS')";

        $RESULT = MYSQLI_QUERY($CON, $QUERY);
        IF($RESULT){
            $SMSG = "PROJECT CREATED SUCCESSFULLY.";
        }ELSE{
            $FMSG ="PROJECT CREATION FAILED";

        }
    }

    ?>

<HTML>
   <BODY>
	  <DIV ID="MIDDLE">
				<H1> ADD PROJECT </H1>
				<TABLE>
						<TR>
							<TD>PROJECT NAME: </TD>
							<TD> <?PHP ECHO $PROJECTNAME?> </TD>
						</TR>
						<TR>
							<TD>PROJECT BRIEF: </TD>
							<TD> <?PHP ECHO $PROJECTBRIEF?> </TD>
						</TR>
						<TR>
							<TD>PROJECT LEADER: </TD>
							<TD> <?PHP ECHO $PROJECTLEADER?> </TD>
						</TR>
						<TR>
							<TD>STATUS: </TD>
							<TD> <?PHP ECHO $PROJECTSTATUS?> </TD>
						</TR>
					</TABLE>
	  </DIV>
   </BODY>
</HTML>
