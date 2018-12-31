<?php
session_start();
require "staffauth.php";
require_once "connectdb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['u'])) {
  if(preg_match('/^SIT[0-9]{3}T[1-3][0-9]{2}$/', $_POST['u'])) {
    $query = "SELECT survey_open FROM unit WHERE unit_ID = '".$_POST['u']."'";
    $res = mysqli_query($CON, $query);
    $row = mysqli_fetch_assoc($res);

    $toggle = ($row['survey_open'] == 1 ? 0 : 1);

    $query = "UPDATE unit SET survey_open = '".$toggle."' WHERE unit_ID = '".$_POST['u']."'";
    mysqli_query($CON, $query);
    header("location: unitlist.php");
  }
}

?>
