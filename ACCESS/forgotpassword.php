<?php
session_start();
REQUIRE('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Login Page";
require "../PAGES/HEADER_PUBLIC.PHP";

// Define variables
$email_Error = FALSE;
$email_Sent = FALSE;

// If form has been submitted, sanitise and process inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['forgotemail']) && preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $_POST['forgotemail'])){
    // Email password reset link.
    $email_Sent = TRUE;
  } else {
    // Invalid Deakin email
    $email_Error = TRUE;
  }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <h2>Forgot Password</h2>
  <?php
    if($email_Error) echo "<p>Invalid Deakin email address.</p>";
    if($email_Sent)  echo "<p>Password reset email sent.</p>";
  ?>
  <input type="email" name="forgotemail" placeholder="Deakin Email Address" id="ip2" required><br><br>
  <button type="submit">Password Reset</button><br /><br />
</form>

<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
