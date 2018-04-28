<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html>
<body>
</div>
<div class="content">
<div class="innerContent">

  <?PHP
  require('../DATABASE/CONNECTDB.PHP');
      // If the values are posted, (created by marc) insert them into the database.
  {
					$SQLQuery =  "SELECT * FROM PROJECT";
					$result = mysqli_query($CON, $SQLQuery);

					echo "<table id='results'>
						  <tr>
							<th>Project Name</th>
							<th>Project Brief</th>
							<th>Project Leader</th>
							<th>Project Status</th>
						  </tr>";

					while ($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['PROJECT_NAME'] . "</td>";
						echo "<td>" . $row['PROJECT_BRIEF'] . "</td>";
						echo "<td>" . $row['PROJECT_LEADER'] . "</td>";
						echo "<td>" . $row['PROJECT_STATUS'] . "</td>";

						echo "</tr>";
					}

					echo "</table>";

					mysqli_close($CON);

        }
				?>
</div>
</div>
</body>
</html>
