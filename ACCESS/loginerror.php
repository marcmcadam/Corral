<?php
session_start();
require('../DATABASE/CONNECTDB.PHP');
$PageTitle = "Error";
require "../PAGES/HEADER_PUBLIC.PHP";
?>

      <form method="POST">
        <h2>Please Log In</h2>
    <span class="input-group-addon" id="basic-addon1"></span>
    <input type="text" name="STUDENT_ID" placeholder="Student ID" id="id2" required><br><br>
        <input type="password" name="STUDENT_PASSWORD" id="id2" placeholder="Password" required><br><br>
        <button type="submit">LOGIN</button>
        <button type="button" onclick="location.href='../ACCESS/REGISTER';" vaule="Register" />REGISTER</button><br><br>
      </form>
<p style="margin-left: 400px">Login error, Credentials do not match. Please try again.</p>

<?php require "../PAGES/FOOTER_PUBLIC.PHP"; ?>
<?php  //Start the Session

//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['STUDENT_ID']) and isset($_POST['STUDENT_PASSWORD'])){
//3.1.1 Assigning posted values to variables.
$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
$salt = 'juhladhfl465adfgadf564a3d5f4g6664645dfgvadf';
$md5 = md5($salt . $password . $salt);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM student WHERE stu_ID='$id' and stu_Password='$md5'";
$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$user = $result->fetch_assoc();
$_SESSION['STUDENT_ID'] = $id;
$_SESSION['STUDENT_FIRSTNAME'] = $user['STUDENT_FIRSTNAME'];
$_SESSION['STUDENT_LASTNAME'] = $user['STUDENT_LASTNAME'];
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
header("location: ../ACCESS/loginerror");
//$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STUDENT_ID'])){
$id = $_SESSION['STUDENT_ID'];
$student_firstname = $_SESSION['STUDENT_FIRSTNAME'];
$student_lastname = $_SESSION['STUDENT_LASTNAME'];
$_SESSION['STUDENT_ID'] = true;
header("location: ../PAGES/STUDENTPROFILE");
}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
