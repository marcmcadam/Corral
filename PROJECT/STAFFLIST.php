<?php
 	$PageTitle = "Staff List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<div id="contents" >

<h2>Staff Information</h2>
<form action="../PROJECT/STAFFCSV" method="post">
	<input type="submit" name="STAFF_CSV" value="Export Staff List To CSV" class="inputButton">
</form>

<form action="../PROJECT/STAFFPDF" method="post">
	<input type="submit" name="STAFF_PDF" value="Export Staff List to PDF" class="inputButton">
</form>
<?php

require('../DATABASE/CONNECTDB.PHP');

$sql="SELECT * FROM STAFF ORDER BY STAFF_ID ASC";
$res=mysqli_query($CON, $sql);

echo "
  <form  name ='staffListForm' action='STAFFUPDATE.php'  method='post'>
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
            <td align='center'><button  action='STAFFUPDATE.php'  value ='".$row['STAFF_ID']."' name='staffid' class='inputButton'>Update</a></td>
          </tr>";
}

echo "</table>";
mysqli_free_result($res);
mysqli_close($CON);

?>
</div>

<?php require "../PAGES/FOOTER_STAFF.PHP"; ?>
