<?php
require_once "../connectdb.php";

//empty existing staff table
$staff = "TRUNCATE staff";
IF (MYSQLI_QUERY($CON, $staff)) {
  ECHO "<P>Staff data deleted</P>";
} ELSE {
  ECHO "Error deleting staff data: " . MYSQLI_ERROR($CON);
}

$insert = 'INSERT INTO staff (STAFF_NUM, STAFF_ID, STAFF_FIRSTNAME, STAFF_LASTNAME, STAFF_LOCATION, STAFF_EMAIL, STAFF_PASSWORD, sort_matrix, sort_random, sort_inertia, sort_iterations) VALUES
(123456789,123456789,"Staff","User",1,"staffuser@deakin.edu.au","21e00641c260a79b8e5ad3eef52dd84c",100,20,20,50)';

IF (MYSQLI_QUERY($CON,$insert)) {
  ECHO "<P>Sample staff data inserted</P>";
} ELSE {
  ECHO "Error inserting sample student data: " . MYSQLI_ERROR($CON);
}

?>
