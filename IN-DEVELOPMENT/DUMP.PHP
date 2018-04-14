
<?PHP

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

?>









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
