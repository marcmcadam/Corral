<?php
require_once "../connectdb.php";

//drop surveyanswer table
$surveyanswer = "DROP TABLE surveyanswer";
if (mysqli_query($CON, $surveyanswer)) {
  echo "<p>surveyanswer table dropped successfully</p>";
} else {
  echo "<p>Error dropping surveyanswer table: " . mysqli_error($CON) . "</p>";
}

//drop student table
$student = "DROP TABLE student";
if (mysqli_query($CON, $student)) {
  echo "<p>student table dropped successfully</p>";
} else {
  echo "<p>Error dropping student table: " . mysqli_error($CON) . "</p>";
}

//drop staff table
$staff = "DROP TABLE staff";
if (mysqli_query($CON, $staff)) {
  echo "<p>staff table dropped successfully</p>";
} else {
  echo "<p>Error dropping staff table: " . mysqli_error($CON) . "</p>";
}

//drop project table
$project = "DROP TABLE project";
if (mysqli_query($CON, $project)) {
  echo "<p>project table dropped successfully</p>";
} else {
  echo "<p>Error dropping project table: " . mysqli_error($CON) . "</p>";
}

//drop groups table
$project = "DROP TABLE groups";
if (mysqli_query($CON, $project)) {
  echo "<p>groups table dropped successfully</p>";
} else {
  echo "<p>Error dropping groups table: " . mysqli_error($CON) . "</p>";
}

//drop password reset table
$passwordreset = "DROP TABLE passwordreset";
if (mysqli_query($CON,$passwordreset)) {
  echo "<p>password reset table dropped successfully</p>";
} else {
  echo "<p>Error dropping password reset table: " . mysqli_error($CON) . "</p>";
};

//drop skill names table
$skillnames = "DROP TABLE skillnames";
if (mysqli_query($CON,$skillnames)) {
  echo "<p>skill names table dropped succesfully</p>";
} else {
  echo "<p>Error dropping skill names table:";
}

//create student table
$student = "CREATE TABLE student (
  stu_ID int(9) NOT NULL PRIMARY KEY,
  stu_FirstName varchar(32) NOT NULL,
  stu_LastName varchar(32) NOT NULL,
  stu_Campus int(1) NOT NULL,
  stu_Email varchar(32) NOT NULL,
  stu_Password varchar(64) NOT NULL,
  stu_Timestamp datetime,
  stu_LockedOut tinyint(1),
  stu_LoginAttempts int(11)
)";

if (mysqli_query($CON,$student)) {
  echo "<p>student table created successfully</p>";
} else {
  echo "<p>Error creating student table: " . mysqli_error($CON) . "</p>";
}

//create staff table
$staff = "CREATE TABLE STAFF (
  STAFF_NUM INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  STAFF_ID INT NOT NULL,
  STAFF_FIRSTNAME VARCHAR(35) NOT NULL,
  STAFF_LASTNAME VARCHAR(35) NOT NULL,
  STAFF_LOCATION VARCHAR(35) NOT NULL,
  STAFF_EMAIL VARCHAR(35) NOT NULL,
  STAFF_PASSWORD VARCHAR(256) NOT NULL,
  SORT_PID INT(11)
)";

if (mysqli_query($CON,$staff)) {
  echo "<p>staff table created successfully</p>";
} else {
  echo "<p>Error creating staff table: " . mysqli_error($CON) . "</p>";
}

//create project table
$project = "CREATE TABLE project (
  pro_num int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pro_title varchar(25) NOT NULL,
  pro_brief varchar(256) NOT NULL,
  pro_leader varchar(25) NOT NULL,
  pro_email varchar(64) NOT NULL,
  pro_status varchar(20) NOT NULL,
  pro_min int(11) NOT NULL,
  pro_max int(11) NOT NULL,
  pro_imp int(11) NOT NULL,
  pro_skill_00 int(11) NOT NULL,
  pro_skill_01 int(11) NOT NULL,
  pro_skill_02 int(11) NOT NULL,
  pro_skill_03 int(11) NOT NULL,
  pro_skill_04 int(11) NOT NULL,
  pro_skill_05 int(11) NOT NULL,
  pro_skill_06 int(11) NOT NULL,
  pro_skill_07 int(11) NOT NULL,
  pro_skill_08 int(11) NOT NULL,
  pro_skill_09 int(11) NOT NULL,
  pro_skill_10 int(11) NOT NULL,
  pro_skill_11 int(11) NOT NULL,
  pro_skill_12 int(11) NOT NULL,
  pro_skill_13 int(11) NOT NULL,
  pro_skill_14 int(11) NOT NULL,
  pro_skill_15 int(11) NOT NULL,
  pro_skill_16 int(11) NOT NULL,
  pro_skill_17 int(11) NOT NULL,
  pro_skill_18 int(11) NOT NULL,
  pro_skill_19 int(11) NOT NULL,
  pro_bias_00 int(11) NOT NULL,
  pro_bias_01 int(11) NOT NULL,
  pro_bias_02 int(11) NOT NULL,
  pro_bias_03 int(11) NOT NULL,
  pro_bias_04 int(11) NOT NULL,
  pro_bias_05 int(11) NOT NULL,
  pro_bias_06 int(11) NOT NULL,
  pro_bias_07 int(11) NOT NULL,
  pro_bias_08 int(11) NOT NULL,
  pro_bias_09 int(11) NOT NULL,
  pro_bias_10 int(11) NOT NULL,
  pro_bias_11 int(11) NOT NULL,
  pro_bias_12 int(11) NOT NULL,
  pro_bias_13 int(11) NOT NULL,
  pro_bias_14 int(11) NOT NULL,
  pro_bias_15 int(11) NOT NULL,
  pro_bias_16 int(11) NOT NULL,
  pro_bias_17 int(11) NOT NULL,
  pro_bias_18 int(11) NOT NULL,
  pro_bias_19 int(11) NOT NULL
)";

if (mysqli_query($CON,$project)) {
  echo "<p>project table created successfully</p>";
} else {
  echo "<p>Error creating project table: " . mysqli_error($CON) . "</p>";
}

//create surveyanswer table
$surveyanswer = "CREATE TABLE surveyanswer (
  stu_ID int(9) NOT NULL PRIMARY KEY,
  stu_skill_00 int(11) NOT NULL,
  stu_skill_01 int(11) NOT NULL,
  stu_skill_02 int(11) NOT NULL,
  stu_skill_03 int(11) NOT NULL,
  stu_skill_04 int(11) NOT NULL,
  stu_skill_05 int(11) NOT NULL,
  stu_skill_06 int(11) NOT NULL,
  stu_skill_07 int(11) NOT NULL,
  stu_skill_08 int(11) NOT NULL,
  stu_skill_09 int(11) NOT NULL,
  stu_skill_10 int(11) NOT NULL,
  stu_skill_11 int(11) NOT NULL,
  stu_skill_12 int(11) NOT NULL,
  stu_skill_13 int(11) NOT NULL,
  stu_skill_14 int(11) NOT NULL,
  stu_skill_15 int(11) NOT NULL,
  stu_skill_16 int(11) NOT NULL,
  stu_skill_17 int(11) NOT NULL,
  stu_skill_18 int(11) NOT NULL,
  stu_skill_19 int(11) NOT NULL
)";

if (mysqli_query($CON,$surveyanswer)) {
  echo "<p>surveyanswer table created successfully</p>";
} else {
  echo "<p>Error creating surveyanswer table: " . mysqli_error($CON) . "</p>";
}

//create groups mysql_list_tables
$groups = "CREATE TABLE groups (
  stu_ID int(9) NOT NULL PRIMARY KEY,
  pro_num int(11) NOT NULL)";

if (mysqli_query($CON,$groups)) {
  echo "<p>groups table created successfully</p>";
} else {
  echo "<p>Error creating groups table: " . mysqli_error($CON) . "</p>";
}

//create passwordreset table
$passwordreset = "CREATE TABLE passwordreset (
  ID int(11) AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255),
  selector CHAR(16),
  token CHAR(64),
  expires BIGINT(20)
)";

if (mysqli_query($CON,$passwordreset)) {
  echo "<p>password reset table created successfully</p>";
} else {
  echo "<p>Error creating password reset table: " . mysqli_error($CON) . "</p>";
}

//create skill names table
$skillnames = "CREATE TABLE skillnames (
  skill_ID int(11) AUTO_INCREMENT PRIMARY KEY,
  skill_00 VARCHAR(30) DEFAULT NULL,
  skill_01 VARCHAR(30) DEFAULT NULL,
  skill_02 VARCHAR(30) DEFAULT NULL,
  skill_03 VARCHAR(30) DEFAULT NULL,
  skill_04 VARCHAR(30) DEFAULT NULL,
  skill_05 VARCHAR(30) DEFAULT NULL,
  skill_06 VARCHAR(30) DEFAULT NULL,
  skill_07 VARCHAR(30) DEFAULT NULL,
  skill_08 VARCHAR(30) DEFAULT NULL,
  skill_09 VARCHAR(30) DEFAULT NULL,
  skill_10 VARCHAR(30) DEFAULT NULL,
  skill_11 VARCHAR(30) DEFAULT NULL,
  skill_12 VARCHAR(30) DEFAULT NULL,
  skill_13 VARCHAR(30) DEFAULT NULL,
  skill_14 VARCHAR(30) DEFAULT NULL,
  skill_15 VARCHAR(30) DEFAULT NULL,
  skill_16 VARCHAR(30) DEFAULT NULL,
  skill_17 VARCHAR(30) DEFAULT NULL,
  skill_18 VARCHAR(30) DEFAULT NULL,
  skill_19 VARCHAR(30) DEFAULT NULL
)";
if (mysqli_query($CON,$skillnames)) {
  echo "<p>skill names table created successfully</p>";
} else {
  echo "<p>Error creating skill names table: " . mysqli_error($CON) . "</p>";
}
?>
