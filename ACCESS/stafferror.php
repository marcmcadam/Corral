<?php
session_start();
require('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Login Page";
require "../PAGES/HEADER_PUBLIC.PHP";
?>

      <form method="POST">
        <h2>Please Log In</h2>
    <span class="input-group-addon" id="basic-addon1"></span>
    <input type="text" name="STAFF_ID" id="ip2" placeholder="Staff ID" required><br><br>
        <input type="password" name="STAFF_PASSWORD" id="ip2" placeholder="Password" required><br><br>
        <button type="submit">LOGIN</button>
        <button type="button" onclick="location.href='../PAGES/STAFFREGISTRATION';" val ue="Register" />REGISTER</button><br><br>
      </form>
<p>Login error, Credentials do not match. Please try again.</p>
<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
<?php  //Start the Session

//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['STAFF_ID']) and isset($_POST['STAFF_PASSWORD'])){
//3.1.1 Assigning posted values to variables.
$id = mysqli_real_escape_string($CON, $_POST['STAFF_ID']);
$password = mysqli_real_escape_string($CON, $_POST['STAFF_PASSWORD']);
$salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
$md5 = md5($salt . $password . $salt);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM STAFF WHERE STAFF_ID='$id' and STAFF_PASSWORD='$md5'";
$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$user = $result->fetch_assoc();
$_SESSION['STAFF_ID'] = $id;
$_SESSION['STAFF_FIRSTNAME'] = $user['STAFF_FIRSTNAME'];
$_SESSION['STAFF_LASTNAME'] = $user['STAFF_LASTNAME'];
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
header("location: ../ACCESS/stafferror");
//$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STAFF_ID'])){
$id = $_SESSION['STAFF_ID'];
$staff_firstname = $_SESSION['STAFF_FIRSTNAME'];
$staff_lastname = $_SESSION['STAFF_LASTNAME'];
$_SESSION['STAFF_ID'] = true;
header("location: ../PAGES/staffprofile");
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
