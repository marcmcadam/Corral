<?php
 	$PageTitle = "Home";
	require "header_student.php";
  require_once "connectdb.php";
  require "getfunctions.php";
  $surveys = getActiveSurveys($id, $CON);

echo "
<div>
  <h2>Welcome,".$student_firstname."</h2>
  <h3>Your Available Surveys</h3>
  <table width='1250px' border='1px' cellpadding='8px' align='center'>
    <tr>
      <th>Unit Code</th>
      <th>Trimester</th>
      <th>Status</th>
      <th>&nbsp;</th>
    </tr>";
foreach($surveys as $survey) {
  echo "
  <tr>
    <td>".substr($survey[0], 0, 6)."</td>
    <td>".substr($survey[0], 6, 2).", 20".substr($survey[0], -2)."</td>
    <td>".($survey[1] == 0 ? 'Not Submitted' : 'Submitted')."</td>
    <td>";
  if ($survey[1] == 0)
    echo "<a href='studentsurvey.php?u=".$survey[0]."'>Complete Survey</a>";
  elseif ($survey[1] == 1)
    echo "<a href='studentsurvey.php?u=".$survey[0]."'>Update Survey</a>";
  echo"</td>
  </tr>
  ";
}
echo "
  </table>
</div>";

require "footer.php";
?>
