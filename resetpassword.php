<?php
require "connectdb.php";
$PageTitle = "Login Page";
require "encryptor.php";// for aes256-cbc function
require "header_public.php";
require "encryptor.php";

// check for tokens
$selector = filter_input(INPUT_GET, 'selector');
$validator = filter_input(INPUT_GET, 'validator');

// If selector and validator are hexadecimal, prompt to reset password
if ( false !== ctype_xdigit( $selector ) && false !== ctype_xdigit( $validator ) ) {  ?>
    <h2>Password Reset</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <input type="hidden" name="selector" value="<?php echo $selector; ?>">
      <input type="hidden" name="validator" value="<?php echo $validator; ?>">
      <input type="password" class="text" class="inputBox" name="new_password" placeholder="Enter a new password" required><br /><br />
      <input type="submit" class="submit" class="inputButton" value="Save New Password">
    </form>
<?php
}
// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // If selector, validator and password are set in _POST, and selector/validator are hex, process
//  Original If statement
//if (  isset($_POST['selector']) && isset($_POST['validator']) && isset($_POST['new_password']) && (false !== ctype_xdigit($_POST['selector']) && false !== ctype_xdigit($_POST['validator'])))
// modified for password complexity min 1 uppercase , 1 lowercase, 1 digit min length 8
// regex expression for test  ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$
// adding preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',isset($_POST['new_password'])
  if (  isset($_POST['selector']) && isset($_POST['validator']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',isset($_POST['new_password'])) && (false !== ctype_xdigit($_POST['selector']) && false !== ctype_xdigit($_POST['validator'])))

   {
    $selector = $_POST['selector']; //Validated above in if statement
    $validator = $_POST['validator']; //Validated above in if statement

    // Pull tokens from database
    $time = strtotime('NOW');
    $query = "SELECT * FROM passwordreset WHERE selector = '".$selector."' AND expires >= '".$time."'";
    $result = mysqli_query($CON, $query);
    $row = mysqli_fetch_assoc($result);

    // Validate tokens
    $auth_token = (isset($row['token']) ? $row['token'] : "" );
    $calc = hash('sha256', hex2bin($validator));

    // Recalculate and compare to avoid crypt timing attack
    if (hash_equals($calc,$auth_token)) {
      // Valid, Reset Password
      // Work out if Staff or Student user
      $email = $row['email'];

      // Check if user is a staff member, if so reset password
      $query = "SELECT count(*) FROM staff WHERE sta_Email = '".$email."'";
      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $row = mysqli_fetch_assoc($result);
      if ($row['count(*)'] == 1) {
        // Reset staff password
        $password = mysqli_real_escape_string($CON, $_POST['new_password']);
        $encryptedaes256=encrypt_decrypt('encrypt',$password);
        $query = "UPDATE staff SET sta_Password='".$encryptedaes256."' WHERE sta_Email = '".$email."'";
        mysqli_query($CON, $query) or die(mysqli_error($CON));
        echo "<p>Your password has been reset, please <a href='stafflogin.php'>login here</a>.</p>";
      }

      // Check if user is a student, if so reset password
      $query = "SELECT count(*) FROM student WHERE stu_Email = '".$email."'";
      $result = mysqli_query($CON, $query) or die(mysqli_error($CON));
      $row = mysqli_fetch_assoc($result);
      if ($row['count(*)'] == 1) {
        // Reset student password
        $password = mysqli_real_escape_string($CON, $_POST['new_password']);
        $encryptedaes256=encrypt_decrypt('encrypt',$password);
        $query = "UPDATE student SET stu_Password='".$encryptedaes256."' WHERE stu_Email = '".$email."'";
        mysqli_query($CON, $query) or die(mysqli_error($CON));
        echo "<p>Your password has been reset, please <a href='login.php'>login here</a>.</p>";
      }
    } else {
      // Invalid tokens used, attack?
      echo "<p>Error(1): Unable to reset password</p>";
    }
  } else {
    // POST variables not set, invalid.
    echo "<p>Error(2): Unable to reset password</p>";
    echo "<p>Password complexity must be adhered to</p>";
  }
}
?>
<?php require "footer.php"; ?>
