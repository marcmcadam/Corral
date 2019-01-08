<?php
 	$PageTitle = "Staff List";
	require "header_staff.php";
  require_once "getfunctions.php";
  require_once "connectdb.php";


  $sql="SELECT * FROM staff ORDER BY sta_ID ASC";
  $res=mysqli_query($CON, $sql);

echo "<h2>Staff Information</h2>
    <form action='staffuser' method='get'>
    <table class='listTable' align='center'>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Campus</th>
            <th>Email</th>
            <th>Update</th>
        </tr>";

while ($row=mysqli_fetch_assoc($res)){
    echo "
  <tr>
    <td>".$row['sta_FirstName']."</td>
    <td>".$row['sta_LastName']."</td>
    <td>".getcampus($row["sta_Campus"])."</td>
    <td>".$row['sta_Email']."</td>
    <td><button value ='".$row['sta_ID']."' name='staffid' class='updateButton'>Update</button></td>
  </tr>";
}

echo "</table></form>";
mysqli_free_result($res);
mysqli_close($CON);
require "footer.php"; ?>
