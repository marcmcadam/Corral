<?php
 	$PageTitle = "Project List";
    require "header_staff.php";
    require_once "connectdb.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        header("location: project");
        die;
    }
?>
<h2>Project List</h2>



<form method="post">
    <input type="submit" value="Create Project" class="inputButton">
</form>

<style>
    tr:nth-child(odd) {
        background-color: #f4f4f4;
    }
    tr:nth-child(even) {
        background-color: #ececec;
    }
</style>

<?php

    $sql = "SELECT * FROM project ORDER BY unit_ID, FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
    $res = mysqli_query($CON, $sql);

    echo "<form name ='projectListForm' action='project.php'  method='get'>
    <table width='1250px' border='1px' cellpadding='8px' align='center'>
        <tr>
            <th>Project Unit</th>
            <th>Project Title</th>
            <th>Project Leader</th>
            <th>Leader Email</th>
            <th>Project Brief</th>
            <th>Project Status</th>
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

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);

    require "footer.php";
?>
