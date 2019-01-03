<?php
function getUnits($CON) {
  $query = "SELECT unit_ID FROM unit";
  $res = mysqli_query($CON, $query);
  $unitcodes = [];
  while($row = mysqli_fetch_assoc($res))
    array_push($unitcodes, $row['unit_ID']);
  return $unitcodes;
}
?>
