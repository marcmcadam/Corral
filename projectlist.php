<?php
 	$PageTitle = "Project List";
    require "header_staff.php";
    require_once "connectdb.php";

    $sql = "SELECT * FROM project ORDER BY unit_ID, FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
    $res = mysqli_query($CON, $sql);

    echo "<h2>Project List</h2>
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
