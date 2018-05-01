<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<?PHP
require('../DATABASE/CONNECTDB.PHP');
    // If the values are posted, insert them into the database.
    if (isset($_POST['STAFF_ID']) && isset($_POST['STAFF_PASSWORD'])){
        $id = mysqli_real_escape_string($CON, $_POST['STAFF_ID']);
				$firstname = mysqli_real_escape_string($CON, $_POST['STAFF_FIRSTNAME']);
				$lastname = mysqli_real_escape_string($CON, $_POST['STAFF_LASTNAME']);
        $location = mysqli_real_escape_string($CON, $_POST['STAFF_LOCATION']);
        $email = mysqli_real_escape_string($CON, $_POST['STAFF_EMAIL']);
        $password = mysqli_real_escape_string($CON, $_POST['STAFF_PASSWORD']);

        $query = "INSERT INTO STAFF (STAFF_ID, STAFF_FIRSTNAME, STAFF_LASTNAME, STAFF_LOCATION, STAFF_EMAIL, STAFF_PASSWORD) VALUES ('$id', '$firstname', '$lastname', '$location', '$email', '$password')";
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
            <label for="inputSTAFF_ID" class="sr-only">STAFF ID</label>
            <input type="text" name="STAFF_ID" id="STAFF_ID" class="form-control" placeholder="STAFF ID" required autofocus>
						<label for="inputFirstName" class="sr-only">First Name</label>
						<input type="text" name="STAFF_FIRSTNAME" id="STAFF_FIRSTNAME" class="form-control" placeholder="First Name" required autofocus>
						<label for="inputLastName" class="sr-only">Last Name</label>
            <input type="text" name="STAFF_LASTNAME" id="STAFF_LASTNAME" class="form-control" placeholder="Last Name" required autofocus>
            <label for="inputLocation" class="sr-only">Location</label>
						<input type="text" name="STAFF_LOCATION" id="STAFF_LOCATION" class="form-control" placeholder="Location" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="STAFF_EMAIL" id="STAFF_EMAIL" class="form-control" placeholder="Email Address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="STAFF_PASSWORD" id="STAFF_PASSWORD" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <a class="btn btn-lg btn-primary btn-block" href="LOGIN.PHP">Login</a>
          </form>
    </div>

<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
