<?php

function getSkillNames($CON, $numSkills) {
  $sql = "SELECT * FROM skillnames WHERE skill_id = 1"; //Hardcoded '1' while only 1 unit managed by Corral
  $res = mysqli_query($CON, $sql);
  if (!$res) {
      echo "Error: " . mysqli_error($CON);
      die;
  }

  $skillNames = [];
  while ($row = mysqli_fetch_assoc($res)) {
    $skillID = $row['skill_ID'];
    if ($skillID == 1) { // hard coded single ID
      for ($i = 0; $i < $numSkills; $i += 1) {
        $name = $row['skill_' . sprintf("%02d", $i)];
        array_push($skillNames, $name);
      }
      break;
    }
  }
  return $skillNames;
}
?>
