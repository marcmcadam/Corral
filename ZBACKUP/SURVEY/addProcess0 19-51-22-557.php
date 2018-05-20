<?php
session_start();

if ( $_SESSION['STAFF_ID'] != 1) {
	$_SESSION['message'] = "You must log in before viewing this page";
	header("location: ../ACCESS/error.php");
	}
	else {
	$id = $_SESSION['STAFF_ID'];
	$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
	$staff_lastname = $_SESSION['STAFF_LASTNAME'];
	}
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Template</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
<style>
/*Picture wont float right?*/

#stockpic

{

    float:right;

}

</style>

</head>



<body>

<div class="Header">

	<h1>The Corral Project</h1>

</div>



<div class="navbar">
	<a href="../PAGES/STAFFHOME.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Projects
			<i class="fa fa-caret-down"></i>
		</button>
        	<div class="dropdown-content">
            		<a href="../PROJECT/ADDPROJECT.php">Create a Project</a>
            		<a href="../PROJECT/NEWGROUP.php">Make Groups</a>
            		<a href="../PROJECT/GROUPLIST.php">Group List</a>
            		<a href="../PROJECT/PROJECTLIST.php">Previous Projects</a>
			<a href="../PROJECT/updatePro.php">Update Projects</a>
		</div>
	</div>
	<a href="../PAGES/STAFFCONTACT.php">Contacts</a>
	<a href="../PAGES/STAFFABOUTUS.php">About Us</a>
	<a href="../ACCESS/stafflogout.php">Logout</a>
</div>



<div id="contents">

  <h2>Project Added</h2>
	<?PHP
	REQUIRE('../DATABASE/CONNECTDB.PHP');
	    // IF THE VALUES ARE POSTED, (CREATED BY MARC) INSERT THEM INTO THE DATABASE.
	{

	  $PROJECTTITLE = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_TITLE']);
		$PROJECTBRIEF = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_BRIEF']);
		$PROJECTLEADER = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_LEADER']);
		$PROJECTEMAIL = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_EMAIL']);
		$PROJECTSTATUS = MYSQLI_REAL_ESCAPE_STRING($CON, $_POST['PROJECT_STATUS']);

	  $QUERY = "INSERT INTO PROJECT (PROJECT_TITLE, PROJECT_LEADER, PROJECT_EMAIL, PROJECT_BRIEF, PROJECT_STATUS)
					   VALUES ('$PROJECTTITLE', '$PROJECTLEADER', '$PROJECTEMAIL', 'PROJECT_BRIEF', '$PROJECTSTATUS')";

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
							<TABLE>
									<TR>
										<TD>PROJECT TITLE: </TD>
										<TD> <?PHP ECHO $PROJECTTITLE?> </TD>
									</TR>
									<TR>
										<TD>PROJECT LEADER: </TD>
										<TD> <?PHP ECHO $PROJECTLEADER?> </TD>
									</TR>
									<TR>
										<TD>LEADER EMAIL: </TD>
										<TD> <?PHP ECHO $PROJECTEMAIL?> </TD>
									</TR>
									<TR>
										<TD>PROJECT BRIEF: </TD>
										<TD> <?PHP ECHO $PROJECTBRIEF?> </TD>
									</TR>
									<TR>
									<TR>
										<TD>STATUS: </TD>
										<TD> <?PHP ECHO $PROJECTSTATUS?> </TD>
									</TR>
								</TABLE>
				  </DIV>
			   </BODY>
			</HTML>


</div>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
