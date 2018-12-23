<?php
$PageTitle = "Search";
require "header_staff.php";
require_once "connectdb.php";
require_once "getcampus.php";

if (!$_SERVER["REQUEST_METHOD"] == "GET") echo "<p>No search term entered.</p>";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // Filter with Regex, Search term should only include uppercase/lowercase/numbers/.@ (to allow email search)
  if(!filter_var($_GET['search'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9.@]+$/")))) echo "<p>Invalid search term entered.</p>";
  else { // Passed regex, execute search with supplied term
    $search = $_GET['search'];

    // Search student table, print link to result
    $query = "SELECT stu_ID, stu_FirstName, stu_LastName, stu_Campus, stu_Email FROM student WHERE (
                stu_ID        LIKE '%".$search."%' OR
                stu_FirstName LIKE '%".$search."%' OR
                stu_LastName  LIKE '%".$search."%' OR
                stu_Email     LIKE '%".$search."%')";
    $res = mysqli_query($CON, $query);

    if (mysqli_num_rows($res) > 0) {
      echo "<p>Student results found: ".mysqli_num_rows($res)."</p>";
      echo "<form name action='studentuser.php' method='get'>
        <table width='1250px' border='1px' cellpadding='8px' align='center'>
          <tr>
              <th>ID</th>
              <th>FirstName</th>
              <th>LastName</th>
              <th>Campus</th>
              <th>Email</th>
              <th>Update</th>
          </tr>";
      while ($row=mysqli_fetch_assoc($res)){
        echo
        "<tr>
            <td align='center'>".$row['stu_ID']."</td>
            <td align='center'>".$row['stu_FirstName']."</td>
            <td align='center'>".$row['stu_LastName']."</td>
            <td align='center'>".getcampus($row["stu_Campus"])."</td>
            <td align='center'>".$row['stu_Email']."</td>
            <td align='center'><button value ='".$row['stu_ID']."' name='studentid' class='inputButton'>Update</button></td>
        </tr>";
      }
      echo "</table><br />";
      mysqli_free_result($res);
    }
    // Search staff table, print link to result
    $query = "SELECT STAFF_ID, STAFF_FIRSTNAME, STAFF_LASTNAME, STAFF_LOCATION, STAFF_EMAIL FROM staff WHERE (
                STAFF_FIRSTNAME LIKE '%".$search."%' OR
                STAFF_LASTNAME  LIKE '%".$search."%' OR
                STAFF_EMAIL     LIKE '%".$search."%')";
    $res = mysqli_query($CON, $query);
    if (mysqli_num_rows($res) > 0) {
      echo "<p>Staff results found: ".mysqli_num_rows($res)."</p>";
      echo
      "<form name='staffListForm' action='staffuser.php' method='get'>
        <table width='1250px' border='1px' cellpadding='8px' align='center'>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Location</th>
            <th>Email</th>
            <th>Update</th>
          </tr>";
      while ($row=mysqli_fetch_assoc($res)){
        echo
        "<tr>
          <td align='center' width='190px'>".$row['STAFF_FIRSTNAME']."</td>
          <td align='center' width='190px'>".$row['STAFF_LASTNAME']."</td>
          <td align='center' width='180px'>".getcampus($row["STAFF_LOCATION"])."</td>
          <td align='center' width='500px'>".$row['STAFF_EMAIL']."</td>
          <td align='center'><button value ='".$row['STAFF_ID']."' name='staffid' class='inputButton'>Update</button></td>
        </tr>";
      }
      echo "</table><br />";
      mysqli_free_result($res);
    }
    // Search project table, prink link to result
    $query = "SELECT pro_num, pro_title, pro_leader, pro_email, pro_status FROM project WHERE (
                pro_title   LIKE '%".$search."%' OR
                pro_leader  LIKE '%".$search."%' OR
                pro_email   LIKE '%".$search."%' OR
                pro_status  LIKE '%".$search."%')";
    $res = mysqli_query($CON, $query);
    if (mysqli_num_rows($res) > 0) {
      echo "<p>Project results found: ".mysqli_num_rows($res)."</p>";
      echo
      "<form name='projectListForm' action='project.php' method='get'>
        <table width='1250px' border='1px' cellpadding='8px' align='center'>
          <tr>
              <th>Project Title</th>
              <th>Project Leader</th>
              <th>Leader Email</th>
              <th>Project Status</th>
              <th>Update</th>
          </tr>";
      while ($row=mysqli_fetch_assoc($res)){
        echo
        "<tr>
          <td align='center' style='max-width: 190px;'>".$row['pro_title']."</td>
          <td align='center' style='max-width: 190px;'>".$row['pro_leader']."</td>
          <td align='center' style='max-width: 180px;'>".$row['pro_email']."</td>
          <td align='center' style='max-width: 180px;'>".$row['pro_status']."</td>
          <td align='center' style='width: 80px;'><button value='".$row['pro_num']."' name='number' class='inputButton'>Update</button></td>
        </tr>";
      }
      echo "</table><br />";
      mysqli_free_result($res);
    }
  }
}


?>
<?php require "footer.php"; ?>
