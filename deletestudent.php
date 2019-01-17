<?php
$PageTitle = "Delete Student";
require "header_staff.php";
require_once "connectdb.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['stu_ID'])) {
    $students = getStu_IDs($CON);
    if (preg_match('/[0-9]{9}/', $_POST['stu_ID']) && in_array($_POST['stu_ID'], $students)) {
      $stu_ID = $_POST['stu_ID'];
      if (!isset($_POST['confirm_delete'])) {
      // Display warning
        echo "
        <h2>Delete Student</h2>
          <p>You have elected to delete student with ID: ".$stu_ID." from the database.</p>
          <p>This will completely remove the student's information and any past enrolments in units.</p>
          <p>WARNING: This action cannot be undone. Proceed?</p>
          <p>
            <table align='center'>
              <tr>
                <td>
                  <form action=".htmlspecialchars($_SERVER['PHP_SELF'])." method='post'>
                    <input type='hidden' name='stu_ID' value='".$stu_ID."' />
                    <input type='hidden' name='confirm_delete' value='yes' />
                    <button type='submit' class='inputButton'>Confirm Delete</button>
                  </form>
                </td>
                <td>
                  <form action='studentlist'><button type='submit' class='inputButton'>Cancel</button></form>
                </td>
              </tr>
            </table>
          </p>
        ";
      } else {
      // Proceed and delete student
      $query = "DELETE FROM student WHERE stu_ID = '$stu_ID'";
      if(mysqli_query($CON, $query)) {
        echo "
        <h2>Delete Student</h2>
          <p>Student with ID: ".$stu_ID." has been deleted.</p>
          <p><a href='studentlist'>Back to student list</a></p>";
      } else {
        echo "Error: ".mysqli_error($CON);
      }
      }
    } else {
      echo "Invalid Student Selected";
    }
  }
}

require "footer.php";
?>
