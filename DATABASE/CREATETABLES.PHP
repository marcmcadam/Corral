<?php
require "CONNECTDB.PHP";

//drop surveyanswer table
$surveyanswer = "DROP TABLE surveyanswer";
if (mysqli_query($CON, $surveyanswer)) {
  echo "<p>surveyanswer table dropped successfully</p>";
} else {
  echo "Error dropping surveyanswer table: " . mysqli_error($CON);
}

//drop student table
$student = "DROP TABLE student";
if (mysqli_query($CON, $student)) {
  echo "<p>student table dropped successfully</p>";
} else {
  echo "Error dropping student table: " . mysqli_error($CON);
}

//drop staff table
$staff = "DROP TABLE staff";
if (mysqli_query($CON, $staff)) {
  echo "<p>staff table dropped successfully</p>";
} else {
  echo "Error dropping staff table: " . mysqli_error($CON);
}

//drop project table
$project = "DROP TABLE project";
if (mysqli_query($CON, $project)) {
  echo "<p>project table dropped successfully</p>";
} else {
  echo "Error dropping project table: " . mysqli_error($CON);
}


//create student table
$student = "CREATE TABLE student (
    stu_ID int(9) NOT NULL,
    stu_FirstName varchar(32) NOT NULL,
    stu_LastName varchar(32) NOT NULL,
    stu_Campus int(1) NOT NULL,
    stu_Email varchar(32) NOT NULL,
    stu_Password varchar(64) NOT NULL,
    PRIMARY KEY (stu_ID)
)";
if (mysqli_query($CON,$student)) {
  echo "<p>student table created successfully</p>";
} else {
  echo "Error creating student table: " . mysqli_error($CON);
}

//create staff table
$staff = "CREATE TABLE STAFF (
STAFF_NUM INT NOT NULL AUTO_INCREMENT,
STAFF_ID INT NOT NULL,
STAFF_FIRSTNAME VARCHAR(35) NOT NULL,
STAFF_LASTNAME VARCHAR(35) NOT NULL,
STAFF_LOCATION VARCHAR(35) NOT NULL,
STAFF_EMAIL VARCHAR(35) NOT NULL,
STAFF_PASSWORD VARCHAR(256) NOT NULL,
PRIMARY KEY (STAFF_NUM))";
if (mysqli_query($CON,$staff)) {
  echo "<p>staff table created successfully</p>";
} else {
  echo "Error creating staff table: " . mysqli_error($CON);
}

//create project table
$project = "CREATE TABLE project (
pro_num int(11) NOT NULL AUTO_INCREMENT,
pro_title varchar(25) NOT NULL,
pro_brief varchar(256) NOT NULL,
pro_leader varchar(25) NOT NULL,
pro_email varchar(25) NOT NULL,
pro_status varchar(20) NOT NULL,
pro_hc int(11) NOT NULL,
pro_js int(11) NOT NULL,
pro_php int(11) NOT NULL,
pro_java int(11) NOT NULL,
pro_c int(11) NOT NULL,
pro_cpp int(11) NOT NULL,
pro_oc int(11) NOT NULL,
pro_db int(11) NOT NULL,
pro_u3 int(11) NOT NULL,
pro_ui int(11) NOT NULL,
pro_se int(11) NOT NULL,
PRIMARY KEY (pro_num))";
if (mysqli_query($CON,$project)) {
  echo "<p>project table created successfully</p>";
} else {
  echo "Error creating project table: " . mysqli_error($CON);
}

$surveyanswer = "CREATE TABLE surveyanswer (
stu_ID int(9) NOT NULL,
stu_hc int(11) NOT NULL,
stu_js int(11) NOT NULL,
stu_php int(11) NOT NULL,
stu_java int(11) NOT NULL,
stu_c int(11) NOT NULL,
stu_cpp int(11) NOT NULL,
stu_oc int(11) NOT NULL,
stu_db int(11) NOT NULL,
stu_u3 int(11) NOT NULL,
stu_ui int(11) NOT NULL,
stu_se int(11) NOT NULL,
PRIMARY KEY (stu_ID))";
if (mysqli_query($CON,$surveyanswer)) {
  echo "<p>surveyanswer table created successfully</p>";
} else {
  echo "Error creating surveyanswer table: " . mysqli_error($CON);
}
?>
