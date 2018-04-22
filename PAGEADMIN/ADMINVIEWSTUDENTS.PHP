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
					$SQLQuery =  "SELECT * FROM STUDENT";
					$result = mysqli_query($CON, $SQLQuery);

					echo "<table id='results'>
						  <tr>
              <th>Student ID </th>
							<th>First Name </th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Location</th>
						  </tr>";

					while ($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['STUDENT_ID'] . "</td>";
						echo "<td>" . $row['STUDENT_FIRSTNAME'] . "</td>";
						echo "<td>" . $row['STUDENT_LASTNAME'] . "</td>";
						echo "<td>" . $row['STUDENT_EMAIL'] . "</td>";
            echo "<td>" . $row[''] . "</td>";

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
