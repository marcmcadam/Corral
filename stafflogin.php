<?php
session_start();
session_regenerate_id();  // prevention of session hijacking
require_once "connectdb.php";
require "encryptor.php";// for aes256-cbc function
$PageTitle = "Login Page";
require "header_public.php";

$login_Error = FALSE;

// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // If Username and Password fields have data
  if (isset($_POST['sta_Email']) and isset($_POST['sta_Password']))
  {
    $email_login = mysqli_real_escape_string($CON, $_POST['sta_Email']);
    $password = mysqli_real_escape_string($CON, $_POST['sta_Password']);

    // Reset variables for login
    $sta_Email = $sta_Password = "";
    $login_Error_Text="Login error";
    $login_Error = FALSE;

      $query = "SELECT * FROM staff WHERE sta_Email='$email_login'";

      // If Staff ID valid  and lockout not enabled

      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $user = $result->fetch_assoc();

      if ($user['sta_Email']!==$email_login and $login_Error==FALSE)
      {
        $login_Error = TRUE;
        $login_Error_Text="Invalid Staff email ( Does not exist! )";
      }
      // Set php server  to +10UTC or use ---date_default_timezone_set('Australia/Melbourne');
      // grab lock out flag,time and attempts
      $loginlockout = $user['sta_LockedOut'];
      $logintimestamp = $user['sta_Timestamp'];
      $loginattempts = $user['sta_LoginAttempts'];
      $lockouttimer=time()-strtotime($logintimestamp);//takes difference of timestamp and now in seconds
      $lockouttimerinmins= 30-round($lockouttimer/60); // works out time remaining in mins
      // test for locked out staff
      if  ($loginlockout==TRUE and $login_Error==FALSE)
          {
          $login_Error = TRUE;
          $login_Error_Text="Locked out of account for ".$lockouttimerinmins." minutes.";

          if ($lockouttimer>1)// 1800 seconds for time of lockout
              {
              $query = "UPDATE staff SET sta_LoginAttempts=5 WHERE sta_Email = '$email_login'";
              mysqli_query($CON, $query) or die(mysqli_error($CON));
              $query = "UPDATE staff SET sta_LockedOut=FALSE WHERE sta_Email = '$email_login'";
              mysqli_query($CON, $query) or die(mysqli_error($CON));
              $login_Error==FALSE;
              $login_Error_Text="Locked Account reset.";
              }
          }

      //  Grab password from staff table
      $storedencryptedhash = $user['sta_Password'];
      $storedhash = encrypt_decrypt('decrypt', $storedencryptedhash);
      $validpassword = password_verify($password, $storedhash);

      // Test Password hash match
  if (!$validpassword && $login_Error==FALSE)
      {
      // Invalid login. ID not in database
      $login_Error = TRUE;
      if ($loginattempts>1)
          {
          $loginattempts-=1;
          $login_Error_Text="Password incorrect ".$loginattempts." attempt";
          if ($loginattempts!==1)
              {
              $login_Error_Text=$login_Error_Text."s";
              }
          $login_Error_Text=$login_Error_Text." left.";


          //update mysqli attempts and locked status

          $query = "UPDATE staff SET sta_LoginAttempts=$loginattempts WHERE sta_Email = '$email_login'";
          mysqli_query($CON, $query) or die(mysqli_error($CON));

          }
      else
          {
          $login_Error_Text="Too many attempts. Account locked for 30 mins";
          $query = "UPDATE staff SET sta_LockedOut=TRUE WHERE sta_Email = '$email_login'";
          mysqli_query($CON, $query) or die(mysqli_error($CON));
          $query = "UPDATE staff SET sta_Timestamp=now() WHERE sta_Email = '$email_login'";
          mysqli_query($CON, $query) or die(mysqli_error($CON));


          }
      }

        //grab rest of staff data
        $_SESSION['sta_Email'] = $sta_Email;
        $_SESSION['sta_FirstName'] = $user['sta_FirstName'];
        $_SESSION['sta_LastName'] = $user['sta_LastName'];

        // Successful login.

        if ($login_Error==FALSE)
        {
            $query = "UPDATE staff SET sta_LoginAttempts=5 WHERE sta_Email = '$email_login'";
            mysqli_query($CON, $query) or die(mysqli_error($CON));
            header("location: staffhome");
        }

      }

}
// end database query for login
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h2>Staff Please Log In</h2>
  <?php if($login_Error) echo "<p>$login_Error_Text</p>";?>
  <input type="text" name="sta_Email" placeholder="Staff Email" class="inputBox" required><br><br>
  <input type="password" name="sta_Password" placeholder="Password" class="inputBox" required><br><br>
  <button type="submit" class="inputButton">Login</button>
  <button type="button" onclick="location.href='forgotpassword.php';" value="Forgot Password" class="inputButton">Forgot Password</button><br /><br />
</form>

<?php require "footer.php"; ?>
