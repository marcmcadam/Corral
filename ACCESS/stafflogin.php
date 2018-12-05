<?php
session_start();
require('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Login Page";
require "../PAGES/HEADER_PUBLIC.PHP";

// Define empty variables
$stu_ID = $stu_Password = "";
$login_Error = FALSE;

// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // If Username and Password fields have data
  if (isset($_POST['STAFF_ID']) and isset($_POST['STAFF_PASSWORD'])){
    $id = mysqli_real_escape_string($CON, $_POST['STAFF_ID']);
    $password = mysqli_real_escape_string($CON, $_POST['STAFF_PASSWORD']);
    $salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
    $md5 = md5($salt . $password . $salt);

      // Pull credential data from database if valid. If valid, only 1 result. Set session variables.
      $query = "SELECT * FROM STAFF WHERE STAFF_ID='$id' and STAFF_PASSWORD='$md5'";
      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $count = mysqli_num_rows($result);
      if ($count == 1){
        $user = $result->fetch_assoc();
        $_SESSION['STAFF_ID'] = $id;
        $_SESSION['STAFF_FIRSTNAME'] = $user['STAFF_FIRSTNAME'];
        $_SESSION['STAFF_LASTNAME'] = $user['STAFF_LASTNAME'];
        // Successful login.
        header("location: ../PAGES/STAFFHOME.PHP");
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
  <input type="text" name="STAFF_ID" placeholder="Staff ID" id="ip2" required><br><br>
  <input type="password" name="STAFF_PASSWORD" id="ip2" placeholder="Password" required><br><br>
  <button type="submit">LOGIN</button><br /><br />
</form>

<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
