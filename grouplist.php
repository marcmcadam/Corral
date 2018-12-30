<?php
 	$PageTitle = "Project List";
	require "header_staff.php";
  require "getcampus.php";
?>
<h2>Student Group Listing</h2>
<style>
    tr:nth-child(odd) {
        background-color: #f4f4f4;
    }
    tr:nth-child(even) {
        background-color: #ececec;
    }
</style>
<?php
  require_once "connectdb.php";

  $sql="SELECT groups.*, student.stu_FirstName, student.stu_LastName, student.stu_Campus, student.stu_Email, project.pro_title FROM ((groups INNER JOIN student ON groups.stu_ID=student.stu_ID) INNER JOIN project ON groups.pro_ID=project.pro_ID) ORDER BY pro_ID ASC";
  $res=mysqli_query($CON, $sql);

  echo "<table width='1250px' border='1px' cellpadding='8px' align='center'>";
  echo "<tr>
          <th>Student ID</th>
          <th>Student FirstName</th>
          <th>Student LastName</th>
          <th>Student Campus</th>
          <th>Student Email</th>
          <th>Project ID</th>
          <th>Project Name</th>
        </tr>";

  while ($row=mysqli_fetch_assoc($res)){
    $row["stu_Campus"] = getcampus($row["stu_Campus"]);
  	echo "<tr>
            <td>{$row['stu_ID']}</td>
            <td>{$row['stu_FirstName']}</td>
            <td>{$row['stu_LastName']}</td>
            <td>{$row['stu_Campus']}</td>
            <td>{$row['stu_Email']}</td>
            <td>{$row['pro_ID']}</td>
            <td>{$row['pro_title']}</td>
          </tr>";
  }

  echo "</table>";
  mysqli_free_result($res);
  mysqli_close($CON);
?>
<?php require "footer.php"; ?>
