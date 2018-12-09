<?php
require "CONNECTDB.PHP";

//empty existing table
$staff = "TRUNCATE skillnames";
IF (MYSQLI_QUERY($CON, $staff)) {
  ECHO "<P>Skill names data deleted</P>";
} ELSE {
  ECHO "Error deleting skill names data: " . MYSQLI_ERROR($CON);
}

$insert = 'INSERT INTO skillnames (skill_ID,skill_01,skill_02,skill_03,skill_04,skill_05,skill_06,skill_07,skill_08,skill_09,skill_10,skill_11) VALUES
(1,"HTML/CSS","JavaScript","PHP","Java","C","C++","Objective C","Database","Unity 3", "UI","Security")';

IF (MYSQLI_QUERY($CON,$insert)) {
  ECHO "<P>Sample staff data inserted</P>";
} ELSE {
  ECHO "Error inserting sample student data: " . MYSQLI_ERROR($CON);
}

?>
