<?php
require "CONNECTDB.PHP";

//empty existing table
$staff = "TRUNCATE skillnames";
IF (MYSQLI_QUERY($CON, $staff)) {
  ECHO "<P>Skill names data deleted</P>";
} ELSE {
  ECHO "Error deleting skill names data: " . MYSQLI_ERROR($CON);
}

$skillNames = [
  "HTML/CSS",
  "JavaScript",
  "PHP",
  "Java",
  "C#",
  "C++",
  "Python",
  "Database",
  "Network",
  "Unity",
  "Security",
  "Cloud",
  "AI",
  "UI",
  "Maths",
  "Media",
  null,
  null,
  null,
  "Management",
  "Written",
  "Verbal",
];

$insert = "INSERT INTO skillnames (skill_ID";
for ($i = 0; $i < 20; $i += 1)
    $insert .= ", skill_" . sprintf("%02d", $i);
$insert .= ") VALUES (1";
for ($i = 0; $i < 20; $i += 1)
{
    $name = $skillNames[$i];
    if (is_null($name))
        $insert .= ", null";
    else
        $insert .= ", '$name'";
}
$insert .= ")";

IF (MYSQLI_QUERY($CON,$insert)) {
  ECHO "<P>Sample skill names data inserted</P>";
} ELSE {
  ECHO "Error inserting sample skill names data: " . MYSQLI_ERROR($CON);
}

?>
