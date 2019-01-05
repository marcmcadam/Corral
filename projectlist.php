<?php
 	$PageTitle = "Project List";
    require "header_staff.php";
    require_once "connectdb.php";
    require "getfunctions.php";

    $units = getUnits($CON);
    $unit_ID = NULL;
    $sql = "SELECT * FROM project ORDER BY unit_ID, FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['unit_ID']) && in_array($_POST['unit_ID'], $units)) {
        $sql = "SELECT * FROM project WHERE unit_ID = '".$_POST['unit_ID']."' ORDER BY unit_ID, FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
        $unit_ID = $_POST['unit_ID'];
      }
    }
    $res = mysqli_query($CON, $sql);

    echo "<h2>Project List</h2>
    <form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'>
      <label for='unit_ID'>Filter by Unit: </label>
      <select name='unit_ID' id='unit_ID' class='inputList'>
        <option value='All'".(isset($unit_ID) ? '' : 'selected').">All</option>";
      foreach($units as $unit) {
        echo "<option value='".$unit."'";
        if($unit == $unit_ID) echo " selected";
        echo ">".substr($unit, 0, 6).", ".substr($unit, 6, 2)." 20".substr($unit, -2)."</option>";
      }
    echo "
      </select>
      <button type='submit' value='Filter' class='inputButton'>Filter</button>
      <br /><br />
    </form>
    <form action='project' method='get'>
    <table class='listTable' align='center'>
        <tr>
            <th>Project Unit</th>
            <th>Project Title</th>
            <th>Project Leader</th>
            <th>Leader Email</th>
            <th>Brief</th>
            <th>Status</th>
            <th>Update</th>
        </tr>";

    while ($row=mysqli_fetch_assoc($res))
    {
        echo "<tr>
                <td align='center' style='max-width: 190px;'>{$row['unit_ID']}</td>
                <td align='center' style='max-width: 190px;'>{$row['pro_title']}</td>
                <td align='center' style='max-width: 190px;'>{$row['pro_leader']}</td>
                <td align='center' style='max-width: 180px;'>{$row['pro_email']}</td>
                <td align='center' style='max-width: 500px;'>{$row['pro_brief']}</td>
                <td align='center' style='max-width: 180px;'>{$row['pro_status']}</td>
                <td align='center' style='width: 80px;'><button value='".$row['pro_ID']."' name='number' class='inputButton'>Update</button></td>
            </tr>";
    }

    echo "</table></form>";
    mysqli_free_result($res);
    mysqli_close($CON);

    require "footer.php";
?>
