<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<?PHP
require('../DATABASE/CONNECTDB.PHP');
    // If the values are posted, insert them into the database.
    if (isset($_POST['STUDENT_ID']) && isset($_POST['STUDENT_PASSWORD'])){
        $id = mysqli_real_escape_string($CON, $_POST['STUDENT_ID']);
				$firstname = mysqli_real_escape_string($CON, $_POST['STUDENT_FIRSTNAME']);
				$lastname = mysqli_real_escape_string($CON, $_POST['STUDENT_LASTNAME']);
        $location = mysqli_real_escape_string($CON, $_POST['STUDENT_LOCATION']);
				$email = mysqli_real_escape_string($CON, $_POST['STUDENT_EMAIL']);
        $password = mysqli_real_escape_string($CON, $_POST['STUDENT_PASSWORD']);

        $query = "INSERT INTO STUDENT (STUDENT_ID, STUDENT_FIRSTNAME, STUDENT_LASTNAME, STUDENT_LOCATION, STUDENT_EMAIL, STUDENT_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$password')";
        $result = mysqli_query($CON, $query);
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
    	</div>
            <label for="inputSTUDENT_ID" class="sr-only">Student ID</label>
            <input type="text" name="STUDENT_ID" id="STUDENT_ID" class="form-control" placeholder="Student ID" required autofocus>
						<label for="inputFirstName" class="sr-only">First Name</label>
						<input type="text" name="STUDENT_FIRSTNAME" id="STUDENT_FIRSTNAME" class="form-control" placeholder="First Name" required autofocus>
						<label for="inputLastName" class="sr-only">Last Name</label>
						<input type="text" name="STUDENT_LASTNAME" id="STUDENT_LASTNAME" class="form-control" placeholder="Last Name" required autofocus>
            <label for="inputLocation" class="sr-only">Location</label>
            <input type="text" name="STUDENT_LOCATION" id="STUDENT_LOCATION" class="form-control" placeholder="Location" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="STUDENT_EMAIL" id="STUDENT_EMAIL" class="form-control" placeholder="Email Address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="STUDENT_PASSWORD" id="STUDENT_PASSWORD" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <a class="btn btn-lg btn-primary btn-block" href="LOGIN.PHP">Login</a>
          </form>
    </div>

<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
