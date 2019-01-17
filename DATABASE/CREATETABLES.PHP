<?php
require_once "../connectdb.php";

// NB: Now that foreign keys are in place, the order in which tables are
// dropped (and created) is relevant.

//drop surveyanswer table
$surveyanswer = "DROP TABLE surveyanswer";
if (mysqli_query($CON, $surveyanswer)) {
  echo "<p>surveyanswer table dropped successfully</p>";
} else {
  echo "<p>Error dropping surveyanswer table: " . mysqli_error($CON) . "</p>";
}

//drop project table
$project = "DROP TABLE project";
if (mysqli_query($CON, $project)) {
  echo "<p>project table dropped successfully</p>";
} else {
  echo "<p>Error dropping project table: " . mysqli_error($CON) . "</p>";
}

//drop unit table
$unit = "DROP TABLE unit";
if (mysqli_query($CON, $unit)) {
  echo "<p>unit table dropped successfully</p>";
} else {
  echo "<p>Error dropping unit table: " . mysqli_error($CON) . "</p>";
}

//drop staff table
$staff = "DROP TABLE staff";
if (mysqli_query($CON, $staff)) {
  echo "<p>staff table dropped successfully</p>";
} else {
  echo "<p>Error dropping staff table: " . mysqli_error($CON) . "</p>";
}

//drop student table
$student = "DROP TABLE student";
if (mysqli_query($CON, $student)) {
  echo "<p>student table dropped successfully</p>";
} else {
  echo "<p>Error dropping student table: " . mysqli_error($CON) . "</p>";
}

//drop password reset table
$passwordreset = "DROP TABLE passwordreset";
if (mysqli_query($CON,$passwordreset)) {
  echo "<p>password reset table dropped successfully</p>";
} else {
  echo "<p>Error dropping password reset table: " . mysqli_error($CON) . "</p>";
};

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
  sta_ID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sta_FirstName varchar(32) NOT NULL,
  sta_LastName varchar(32) NOT NULL,
  sta_Campus int(1) NOT NULL,
  sta_Email varchar(32) NOT NULL,
  sta_Password varchar(64) NOT NULL,
  sta_Timestamp datetime DEFAULT NULL,
  sta_LockedOut tinyint(1) DEFAULT NULL,
  sta_LoginAttempts int(11) DEFAULT NULL
)";
if (mysqli_query($CON,$staff)) {
  echo "<p>staff table created successfully</p>";
} else {
  echo "<p>Error creating staff table: " . mysqli_error($CON) . "</p>";
}

//create unit table
$unit = "CREATE TABLE unit (
  unit_ID varchar(10) NOT NULL,
  unit_Name varchar(32) NOT NULL,
  sta_ID int(11) NOT NULL,
  survey_open tinyint(1) DEFAULT 0,
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
  skill_19 VARCHAR(30) DEFAULT NULL,
  sort_matrix INT(11) NOT NULL DEFAULT 100,
  sort_inertia INT(11) NOT NULL DEFAULT 0,
  sort_random INT(11) NOT NULL DEFAULT 10,
  sort_iterations INT(11) NOT NULL DEFAULT 100,
  sort_pid INT(11) DEFAULT NULL,
  sort_stop TINYINT(1) NOT NULL DEFAULT 0,
  sort_i INT(11) NOT NULL DEFAULT 0,
  sort_m INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (unit_ID),
  FOREIGN KEY (sta_ID) REFERENCES staff(sta_ID)
)";
if (mysqli_query($CON,$unit)) {
  echo "<p>unit table created successfully</p>";
} else {
  echo "<p>Error creating unit table: " . mysqli_error($CON) . "</p>";
}

//create project table
$project = "CREATE TABLE project (
  pro_ID int(11) NOT NULL AUTO_INCREMENT,
  unit_ID varchar(10) NOT NULL,
  pro_title varchar(25) NOT NULL,
  pro_brief varchar(256) NOT NULL,
  pro_leader varchar(25) NOT NULL,
  pro_email varchar(64) NOT NULL,
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
  pro_bias_19 int(11) NOT NULL,
  PRIMARY KEY (pro_ID),
  FOREIGN KEY (unit_ID) REFERENCES unit(unit_ID)
)";
if (mysqli_query($CON,$project)) {
  echo "<p>project table created successfully</p>";
} else {
  echo "<p>Error creating project table: " . mysqli_error($CON) . "</p>";
}

//create surveyanswer table
$surveyanswer = "CREATE TABLE surveyanswer (
  stu_ID int(9) NOT NULL,
  unit_ID varchar(10) NOT NULL,
  pro_ID int(11) DEFAULT NULL,
  pro_locked tinyint(1) DEFAULT 0,
  submitted tinyint(1) DEFAULT 0,
  stu_skill_00 int(11) DEFAULT NULL,
  stu_skill_01 int(11) DEFAULT NULL,
  stu_skill_02 int(11) DEFAULT NULL,
  stu_skill_03 int(11) DEFAULT NULL,
  stu_skill_04 int(11) DEFAULT NULL,
  stu_skill_05 int(11) DEFAULT NULL,
  stu_skill_06 int(11) DEFAULT NULL,
  stu_skill_07 int(11) DEFAULT NULL,
  stu_skill_08 int(11) DEFAULT NULL,
  stu_skill_09 int(11) DEFAULT NULL,
  stu_skill_10 int(11) DEFAULT NULL,
  stu_skill_11 int(11) DEFAULT NULL,
  stu_skill_12 int(11) DEFAULT NULL,
  stu_skill_13 int(11) DEFAULT NULL,
  stu_skill_14 int(11) DEFAULT NULL,
  stu_skill_15 int(11) DEFAULT NULL,
  stu_skill_16 int(11) DEFAULT NULL,
  stu_skill_17 int(11) DEFAULT NULL,
  stu_skill_18 int(11) DEFAULT NULL,
  stu_skill_19 int(11) DEFAULT NULL,
  PRIMARY KEY (stu_ID, unit_ID),
  FOREIGN KEY (stu_ID) REFERENCES student(stu_ID),
  FOREIGN KEY (unit_ID) REFERENCES unit(unit_ID),
  FOREIGN KEY (pro_ID) REFERENCES project(pro_ID)
)";
if (mysqli_query($CON,$surveyanswer)) {
  echo "<p>surveyanswer table created successfully</p>";
} else {
  echo "<p>Error creating surveyanswer table: " . mysqli_error($CON) . "</p>";
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
?>
