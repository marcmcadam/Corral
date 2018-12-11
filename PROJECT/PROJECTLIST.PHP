<?php
 	$PageTitle = "Project List";
	require "../PAGES/HEADER_STAFF.PHP";
?>
<h2>Project List</h2>

<form action="../PROJECT/PROJECTLISTCSV" method="post">
    <select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select>
	<input type="submit" name="export_excel" value="Export As CSV">
</form>
<form action="../PROJECT/PROJECTLISTPDF" method="post">
	<select name="View">
		<option value="All">All</option>
		<option value="Active">Active Projects</option>
		<option value="Inactive">Inactive Projects</option>
		<option value="Planning">Planning Projects</option>
		<option value="Cancelled">Cancelled Projects</option>
	</select>
	<input type="submit" name="export_PDF" value="Export As PDF">
</form>

<?php
    require_once '../DATABASE/CONNECTDB.PHP';

    $sql = "SELECT * FROM project ORDER BY FIELD(pro_status, 'Active', 'Planning', 'Inactive', 'Cancelled'), pro_title ASC";
    $res = mysqli_query($CON, $sql);

    echo "<table width='1250px' border='1px' cellpadding='8px' align='center'>
        <tr>
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
                <td align='center' width='190px'>{$row['pro_title']}</td>
                <td align='center' width='190px'>{$row['pro_leader']}</td>
                <td align='center' width='180px'>{$row['pro_email']}</td>
                <td align='center' width='500px'>{$row['pro_brief']}</td>
                <td align='center' width='180px'>{$row['pro_status']}</td>
                <td align='center'><a href='PROJECT.PHP?number={$row['pro_num']}'>Update</a></td>
            </tr>";
    }

    echo "</table>";
    mysqli_free_result($res);
    mysqli_close($CON);

    require "../PAGES/FOOTER_STAFF.PHP";
?>
