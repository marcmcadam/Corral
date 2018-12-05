<?php
session_start();
REQUIRE('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Login Page";
require "../PAGES/HEADER_PUBLIC.PHP";

// Define empty variables
$stu_ID = $stu_Password = "";
$login_Error = FALSE;

// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // If Username and Password fields have data & student ID is a valid 9 digit number
  if (isset($_POST['STUDENT_ID']) && preg_match('/^[1-9][0-9]{8}$/',$_POST['STUDENT_ID']) && isset($_POST['STUDENT_PASSWORD'])){
    $id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
    $password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
    $salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
    $md5 = md5($salt . $password . $salt);

    // Pull credential data from database if valid. If valid, only 1 result. Set session variables.
    $query = "SELECT * FROM student WHERE stu_ID='$id' and stu_Password='$md5'";
    $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
    $count = mysqli_num_rows($result);
      if ($count == 1){
        $user = $result->fetch_assoc();
        $_SESSION['STUDENT_ID'] = $id;
        $_SESSION['STUDENT_FIRSTNAME'] = $user['STUDENT_FIRSTNAME'];
        $_SESSION['STUDENT_LASTNAME'] = $user['STUDENT_LASTNAME'];
        // Successful login.
        header("location: ../PAGES/STUDENTHOME.PHP");
      } else {
        // Invalid login.
        $login_Error = TRUE;
      }
  } else {
    // Invalid login.
    $login_Error = TRUE;
  }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h2>Please Log In</h2>
  <p><?php if($login_Error) echo "Invalid Username or Password";?></p>
  <input type="text" name="STUDENT_ID" placeholder="Student ID" id="ip2" required><br><br>
  <input type="password" name="STUDENT_PASSWORD" id="ip2" placeholder="Password" required><br><br>
  <button type="submit">LOGIN</button><br><br>
</form>

<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
