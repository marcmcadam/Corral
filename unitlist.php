<?php
$PageTitle = "Unit List";
require "header_staff.php";
require_once "connectdb.php";


$sql = "SELECT u.unit_ID, u.sta_ID, u.survey_open, s.sta_FirstName, s.sta_LastName FROM unit u INNER JOIN staff s ON u.sta_ID=s.sta_ID";
$res = mysqli_query($CON, $sql);

echo "
<table width='1250px' border='1px' cellpadding='8px' align='center'>
  <tr>
    <th>Unit Code</th>
    <th>Trimester</th>
    <th>Unit Chair</th>
    <th colspan='2'>Survey Status</th>
    <th>Update</th>
  </tr>";

while ($row=mysqli_fetch_assoc($res)) {
  echo "
  <tr>
    <td>".substr($row['unit_ID'], 0, 6)."</td>
    <td>".substr($row['unit_ID'], 6, 2).", 20".substr($row['unit_ID'], -2)."</td>
    <td>".$row['sta_FirstName']." ".$row['sta_LastName']."</td>
    <td width='150px' align='center'>".($row['survey_open'] == 1 ? 'Open' : 'Closed')."</td>
    <td width='150px' align='center'><form method='post'><button name='u' value='".$row['unit_ID']."' formaction='togglesurvey.php' class='inputButton'>".($row['survey_open'] == 1 ? 'Close' : 'Open')." Survey</button></form></td>
    <td align='center'><form method='get'><button name='u' value='".$row['unit_ID']."' formaction='unit.php' class='inputButton'>Update</button></form></td>
  </tr>";
}
echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

require "footer.php";
?>
