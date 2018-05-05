<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<?PHP
require('../DATABASE/CONNECTDB.PHP');

$result1 = mysqli_query($con,"SELECT * FROM PROJECT");

echo "<table border='1'>
<tr>
<th>PROJECT NUM</th>
<th>PROJECT BRIEF</th>
<th>PROJECT LEADER</th>
<th>PROJECT EMAIL </th>
<th>PROJECT STATUS</th>
</tr>";

while($row = mysqli_fetch_array($result1)) {
  echo "<tr>";
  echo "<td>" . $row['PROJECT_NUM'] . "</td>";
  echo "<td>" . $row['PROJECT_BRIEF'] . "</td>";
  echo "<td>" . $row['PROJECT_LEADER'] . "</td>";
  echo "<td>" . $row['PROJECT_EMAIL'] . "</td>";
  echo "<td>" . $row['PROJECT_STATUS'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
