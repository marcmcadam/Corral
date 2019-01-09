<?php
session_start();
require_once "connectdb.php";
$PageTitle = "Login Page";
require "header_public.php";

// Define empty variables
$sta_Email = $sta_Password = "";
$login_Error = FALSE;

// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // If Username and Password fields have data
  if (isset($_POST['sta_Email']) and isset($_POST['sta_Password'])){
    $sta_Email = mysqli_real_escape_string($CON, $_POST['sta_Email']);
    $sta_password = mysqli_real_escape_string($CON, $_POST['sta_Password']);
    $salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
    $md5 = md5($salt . $sta_password . $salt);

      // Pull credential data from database if valid. If valid, only 1 result. Set session variables.
      $query = "SELECT * FROM staff WHERE sta_Email='$sta_Email' and sta_Password='$md5'";
      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $count = mysqli_num_rows($result);
      if ($count == 1){
        $user = $result->fetch_assoc();
        $_SESSION['sta_Email'] = $sta_Email;
        $_SESSION['sta_FirstName'] = $user['sta_FirstName'];
        $_SESSION['sta_LastName'] = $user['sta_LastName'];
        // Successful login.
        header("location: staffhome");
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
  <?php if($login_Error) echo "<p>Invalid Username or Password.</p>";?>
  <input type="text" name="sta_Email" placeholder="Staff Email" class="inputBox" required><br><br>
  <input type="password" name="sta_Password" placeholder="Password" class="inputBox" required><br><br>
  <button type="submit" class="inputButton">Login</button>
  <button type="button" onclick="location.href='forgotpassword.php';" value="Forgot Password" class="inputButton">Forgot Password</button><br /><br />
</form>

<?php require "footer.php"; ?>
