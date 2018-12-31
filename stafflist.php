<?php
 	$PageTitle = "Staff List";
	require "header_staff.php";
  require "getcampus.php";
  
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
    <td align='center' width='190px'>".$row['sta_FirstName']."</td>
    <td align='center' width='190px'>".$row['sta_LastName']."</td>
    <td align='center' width='180px'>".getcampus($row["sta_Campus"])."</td>
    <td align='center' width='500px'>".$row['sta_Email']."</td>
    <td align='center'><button value ='".$row['sta_ID']."' name='staffid' class='updateButton'>Update</button></td>
  </tr>";
}

echo "</table></form>";
mysqli_free_result($res);
mysqli_close($CON);
require "footer.php"; ?>
