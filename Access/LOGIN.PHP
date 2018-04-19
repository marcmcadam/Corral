<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="../styles/styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Log In</h2>
        <div class="input-group">
    <span class="input-group-addon" id="basic-addon1">#</span>
    <input type="text" name="STUDENT_ID" class="form-control" placeholder="Student ID" required>
  </div>
        <input type="password" name="STUDENT_PASSWORD" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">LOGIN</button>
        <a class="btn btn-lg btn-primary btn-block" href="REGISTER.PHP">REGISTER</a>
      </form>
</div>

<?php  //Start the Session
session_start();
require('../DATABASE/CONNECTDB.PHP');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['STUDENT_ID']) and isset($_POST['STUDENT_PASSWORD'])){
//3.1.1 Assigning posted values to variables.
$id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
$password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM STUDENT WHERE STUDENT_ID='$id' and STUDENT_PASSWORD='$password'";
$result = mysqli_query($CON, $query) or die(mysqli_error($CON));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['STUDENT_ID'] = $id;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['STUDENT_ID'])){
$id = $_SESSION['STUDENT_ID'];
echo "Hi " . $id . "";
echo "This is the Members Area";
echo "<a href='logout.php'>Logout</a>";

}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
