<?php
session_start();
require "staffauth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['stu_ID'])) {
    $students = getStu_IDs($CON);
    if (preg_match('/[0-9]{9}/', $_POST['stu_ID']) && in_array($_POST['stu_ID'], $students)) {
      $stu_ID = $_POST['stu_ID'];
      if (isset($_POST['unit_ID'])) {
        $units = getUnits($CON);
        if (in_array($_POST['unit_ID'], $units)) {
          $unit_ID = $_POST['unit_ID'];
          $query = "DELETE FROM surveyanswer WHERE stu_ID = '".$stu_ID."' AND unit_ID = '".$unit_ID."'";
          if(mysqli_query($CON, $query))
            echo "Withdrew student: ".$stu_ID." from unit: ".$unit_ID.".";
          else {
            echo "Error: ".mysqli_error($CON);
          }
        } else header('location: studentuser?studentid='.$stu_ID); // Invalid Unit_ID
      } else header('location: studentuser?studentid='.$stu_ID); // Unit_ID not set
    } else header('location: studentuser?studentid='.$stu_ID); // Invalid Stu_ID
  } else header('location: studentuser?studentid='.$stu_ID); // Stu_ID not set
} else header('location: studentuser?studentid='.$stu_ID); // Not POST
header('location: studentuser?studentid='.$stu_ID); // Successfully withdrew student
?>
