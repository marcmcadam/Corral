
<?PHP

<div class="container">

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">REGISTER</h2>
        <div class="input-group">
  </div>


        <SELECT ID="ANSWER" NAME="ANSWER" CLASS="TXTBOX">
        <OPTION VALUE="">-SELECT-</OPTION>;
        <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>

        </SELECT>

        <a class="btn btn-lg btn-primary btn-block" href="LOGIN.PHP">SUBMIT</a>
      </form>
</div>


$MYSQLI = NEW MYSQLI("LOCALHOST", "ADMIN", "PASSWORD1", "CORRAL_PROJECT");


        <SELECT ID="ANSWER" NAME="EMPLOYMENT" CLASS="TXTBOX">
        <OPTION VALUE="">-EMPLOYMENT-</OPTION>
        <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>
        </SELECT>

        <BR>
        <BR>

        <SELECT ID="ANSWER" NAME="COURSES" CLASS="TXTBOX">
        <OPTION VALUE="">-COURSES-</OPTION>
        <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>
        </SELECT>

        <BR>
        <BR>

        <SELECT ID="ANSWER" NAME="SKILLS" CLASS="TXTBOX">
        <OPTION VALUE="">-SKILLS-</OPTION>
        <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>
        </SELECT>

        <BR>
        <BR>

        <SELECT ID="ANSWER" NAME="TECHNICAL SKILLS" CLASS="TXTBOX">
        <OPTION VALUE="">-TECHNICAL SKILLS-</OPTION>
        <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>
        </SELECT>

        <BR>
        <BR>

?>
//LIST ITEMS FROM DATABASE
<?php

$mysqli = new mysqli("LOCALHOST", "ADMIN", "PASSWORD1", "CORRAL_PROJECT");
$sqlSelect="SELECT ANSWER FROM ANSWER";
$result = $mysqli -> query ($sqlSelect);

while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
}

foreach ($rows as $row) {
    print "<option value='" . $row['ANSWER'] . "'>" . $row['ANSWER'] . "</option>";
}













$SQL2 = "CREATE TABLE QUESTION (
QUESTION_NUM INT NOT NULL AUTO_INCREMENT,
QUESTION1 VARCHAR(55) NOT NULL,
QUESTION2 VARCHAR(55) NOT NULL,
QUESTION3 VARCHAR(55) NOT NULL,
QUESTION4 VARCHAR(55) NOT NULL,
QUESTION5 VARCHAR(55) NOT NULL,
PRIMARY KEY (QUESTION_NUM))";

// Execute query
if (mysqli_query($con,$sql2)) {
  echo "<p>Question tables created successfully</p>";
} else {
  echo "Error creating Question table: " . mysqli_error($con);
}

$SQL3 = "CREATE TABLE ANSWER (
ANSWER_NUM INT NOT NULL AUTO_INCREMENT,
ANSWER1 VARCHAR(55) NOT NULL,
ANSWER2 VARCHAR(55) NOT NULL,
ANSWER3 VARCHAR(55) NOT NULL,
ANSWER4 VARCHAR(55) NOT NULL,
ANSWER5 VARCHAR(55) NOT NULL,
STUDENT_ID INT NOT NULL
FOREIGN KEY (STUDENT_ID) REFERENCES STUDENT,
PRIMARY KEY (ANSWER_NUM))";
