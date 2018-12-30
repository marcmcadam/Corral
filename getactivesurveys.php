<?php
function getActiveSurveys($stu_ID, $CON) {
  $query = "SELECT s.unit_ID, s.submitted FROM surveyanswer s INNER JOIN unit u ON s.unit_ID=u.unit_ID WHERE s.stu_ID = $stu_ID AND u.survey_open = 1";
  $res = mysqli_query($CON, $query);
  $units = [];
  while ($row = mysqli_fetch_assoc($res))
    array_push($units, [$row['unit_ID'], $row['submitted']]);
  return $units;
}
?>
