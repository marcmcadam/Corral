<?php
 	$PageTitle = "Staff List";
	require "header_staff.php";
?>

<h2>Staff Information</h2>
<?php

require_once "connectdb.php";

$sql="SELECT * FROM STAFF ORDER BY STAFF_ID ASC";
$res=mysqli_query($CON, $sql);

echo "
  <form  name ='staffListForm' action='staffupdate.php'  method='post'>
    <table width='1250px' height='150px' border='1px' cellpadding='10px' align='center'>";
echo "<tr><th>ID</th><th>FIRSTNAME</th><th>LASTNAME</th><th>LOCATION</th><th>EMAIL</th><th>Update Information</th></tr>";

while ($row=mysqli_fetch_assoc($res)){
    print "<tr>
            <td align='center' width='70px'>".$row['STAFF_ID']."</td>
            <td align='center' width='190px'>".$row['STAFF_FIRSTNAME']."</td>
            <td align='center' width='190px'>".$row['STAFF_LASTNAME']."</td>
            <td align='center' width='180px'>";
            switch ($row["STAFF_LOCATION"]) {
              case 1:
                echo "Burwood";
                break;
              case 2:
                echo "Geelong";
                break;
              case 3:
                echo "Cloud";
                break;
            } print "</td>
            <td align='center' width='500px'>".$row['STAFF_EMAIL']."</td>
            <td align='center'><button  action='staffupdate.php' value ='".$row['STAFF_ID']."' name='staffid' class='inputButton'>Update</a></td>
          </tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>

<?php require "footer.php"; ?>
