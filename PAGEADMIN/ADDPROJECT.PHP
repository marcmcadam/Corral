<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<HTML>
<BODY>
<H1> CREATE A PROJECT </H1>
      <FORM ACTION="ADDEDPROJECT.PHP" METHOD="POST">
      <TABLE>
      <TR>
      <TD>PROJECT NAME:</TD>
        <TD> <INPUT TYPE="TEXT" SIZE=30 MAXLENGTH=30 NAME="PROJECT_NAME" AUTOFOCUS REQUIRED/> </TD>
      </TR>
      <TR>
        <TD>DESCRIPTION:</TD>
      <TD> <TEXTAREA NAME ="PROJECT_BRIEF" MAXLENGTH=5000 ROWS=10 COLS=70 REQUIRED></TEXTAREA> </TD>
      </TR>
      <TR>
      <TD>PROJECT LEADER:</TD>
        <TD> <INPUT TYPE="TEXT" SIZE=30 MAXLENGTH=30 NAME="PROJECT_LEADER" AUTOFOCUS REQUIRED/> </TD>
      </TR>
      <TR>
      <TD>STATUS:</TD>
        <TD> <INPUT TYPE="TEXT" SIZE=30 MAXLENGTH=30 NAME="PROJECT_STATUS" PLACEHOLDER="ACTIVE, IMPEDED, PLANNING" AUTOFOCUS REQUIRED/> </TD>
      </TR>
						<TR>
							<TD><INPUT TYPE='SUBMIT'/></TD>
						</TR>
					</TABLE>
				</FORM>
   </BODY>

</HTML>
