<?php
require_once "../connectdb.php";

//empty existing staff table
$staff = "TRUNCATE staff";
IF (MYSQLI_QUERY($CON, $staff)) {
  ECHO "<P>Staff data deleted</P>";
} ELSE {
  ECHO "Error deleting staff data: " . MYSQLI_ERROR($CON);
}

$insert = 'INSERT INTO staff (sta_ID, sta_FirstName, sta_LastName, sta_Campus, sta_Email, sta_Password) VALUES
(1,"Staff","User",1,"staffuser@deakin.edu.au","21e00641c260a79b8e5ad3eef52dd84c")';

IF (MYSQLI_QUERY($CON,$insert)) {
  ECHO "<P>Sample staff data inserted</P>";
} ELSE {
  ECHO "Error inserting sample student data: " . MYSQLI_ERROR($CON);
}

?>
