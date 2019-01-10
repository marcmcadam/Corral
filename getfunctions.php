<?php
function getSkillNames($CON, $numSkills, $unit_ID) {
  $sql = "SELECT * FROM unit WHERE unit_ID = '".$unit_ID."'";
  $res = mysqli_query($CON, $sql);
  if (!$res) {
    echo "Error: " . mysqli_error($CON);
    die;
  }

  $skillNames = [];
  while ($row = mysqli_fetch_assoc($res)) {
    for ($i = 0; $i < $numSkills; $i += 1) {
      $name = $row['skill_' . sprintf("%02d", $i)];
      array_push($skillNames, $name);
    }
    break;
  }
  return $skillNames;
}

function getUnits($CON) {
  $query = "SELECT unit_ID FROM unit";
  $res = mysqli_query($CON, $query);
  $unitcodes = [];
  while($row = mysqli_fetch_assoc($res))
    array_push($unitcodes, $row['unit_ID']);
  return $unitcodes;
}

function getStaffUnits($CON, $staff) {
  $query = "SELECT unit_ID FROM unit u, staff s WHERE u.sta_ID=s.sta_ID AND sta_Email='$staff'";
  $res = mysqli_query($CON, $query);
  $unitcodes = [];
  while($row = mysqli_fetch_assoc($res))
    array_push($unitcodes, $row['unit_ID']);
  return $unitcodes;
}

function getStaff($CON, $names = FALSE) {
  if($names)
    $query = "SELECT sta_ID, sta_FirstName, sta_LastName FROM staff";
  else
    $query = "SELECT sta_ID FROM staff";
  $res = mysqli_query($CON, $query);
  $staff = [];
  if($names){
    while($row = mysqli_fetch_assoc($res)) {
      $member = [$row['sta_ID'], $row['sta_FirstName'], $row['sta_LastName']];
      array_push($staff, $member);
    }
  } else {
  while($row = mysqli_fetch_assoc($res))
    array_push($staff, $row['sta_ID']);
  }
  return $staff;
}

function getcampus($int) {
  switch ($int) {
    case 1:
      return "Burwood";
    case 2:
      return "Geelong";
    case 3:
      return "Cloud";
  }
}

function getActiveSurveys($stu_ID, $CON) {
  $query = "SELECT s.unit_ID, s.submitted FROM surveyanswer s INNER JOIN unit u ON s.unit_ID=u.unit_ID WHERE s.stu_ID = $stu_ID AND u.survey_open = 1";
  $res = mysqli_query($CON, $query);
  $units = [];
  while ($row = mysqli_fetch_assoc($res))
    array_push($units, [$row['unit_ID'], $row['submitted']]);
  return $units;
}
?>
