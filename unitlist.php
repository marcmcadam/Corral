<?php
$PageTitle = "Unit List";
require "header_staff.php";
require_once "connectdb.php";


$sql = "SELECT unit_ID, survey_open FROM unit u, staff s WHERE u.sta_Id=s.sta_Id AND s.sta_Email='$id'";
$res = mysqli_query($CON, $sql);

echo "<h2>Unit List</h2>
<table align='center' class='listTable'>
  <tr>
    <th>Unit Code</th>
    <th>Trimester</th>
    <th colspan='2'>Survey Status</th>
    <th>Update</th>
  </tr>";

while ($row=mysqli_fetch_assoc($res)) {
  echo "
  <tr>
    <td>".substr($row['unit_ID'], 0, 6)."</td>
    <td>".substr($row['unit_ID'], 6, 2).", 20".substr($row['unit_ID'], -2)."</td>
    <td align='center'>".($row['survey_open'] == 1 ? 'Open' : 'Closed')."</td>
    <td align='center'><form method='post'><button name='u' value='".$row['unit_ID']."' formaction='togglesurvey.php' class='updateButton'>".($row['survey_open'] == 1 ? 'Close' : 'Open')." Survey</button></form></td>
    <td align='center'><form method='get'><button name='u' value='".$row['unit_ID']."' formaction='unit.php' class='updateButton'>Update</button></form></td>
  </tr>";
}
echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

require "footer.php";
?>
