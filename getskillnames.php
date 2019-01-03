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
?>
