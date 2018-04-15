<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="../styles/styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<?PHP
REQUIRE('../DATABASE/CONNECTDB.PHP');
?>

<?PHP
    // If the values are posted, insert them into the database.
    if (isset($_POST['STUDENT_ID']) && isset($_POST['STUDENT_PASSWORD'])){
        $id = mysqli_real_escape_string($connection, $_POST['STUDENT_ID']);
				$firstname = mysqli_real_escape_string($connection, $_POST['STUDENT_FIRSTNAME']);
				$lastname = mysqli_real_escape_string($connection, $_POST['STUDENT_LASTNAME']);
				$email = mysqli_real_escape_string($connection, $_POST['STUDENT_EMAIL']);
        $password = mysqli_real_escape_string($connection, $_POST['STUDENT_PASSWORD']);

        $query = "INSERT INTO STUDENT (STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_EMAIL, STUDENT_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$email', '$password')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }
    ?>

    <div class="container">
          <form class="form-signin" method="POST">
            <h2 class="form-signin-heading">REGISTER</h2>
            <div class="input-group">
    	  <span class="input-group-addon" id="basic-addon1">#</span>
    	  <input type="text" name="STUDENT_ID" class="form-control" placeholder="Student ID" required>
    	</div>
						<label for="inputFirstName" class="sr-only">First Name</label>
						<input type="text" name="STUDENT_FIRSTNAME" id="inputFirstName" class="form-control" placeholder="First Name" required autofocus>
						<label for="inputLastName" class="sr-only">Last Name</label>
						<input type="text" name="STUDENT_LASTNAME" id="inputLastName" class="form-control" placeholder="Last Name" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="STUDENT_EMAIL" id="inputEmail" class="form-control" placeholder="Email Address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="STUDENT_PASSWORD" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <a class="btn btn-lg btn-primary btn-block" href="LOGIN.PHP">Login</a>
          </form>
    </div>

<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
