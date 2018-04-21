<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="../styles/styles.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<?PHP
require('../DATABASE/CONNECTDB.PHP');
    // If the values are posted, (created by marc) insert them into the database.
{       if (isset($_POST['submit']))
        $brief = mysqli_real_escape_string($CON, $_POST['PROJECT_BRIEF']);
				$leader = mysqli_real_escape_string($CON, $_POST['PROJECT_LEADER']);
        $email = mysqli_real_escape_string($CON, $_POST['PROJECT_EMAIL']);

        $query = "INSERT INTO PROJECT (PROJECT_BRIEF, PROJECT_LEADER, PROJECT_EMAIL) VALUES ('$brief', '$leader', '$email')";
        $result = mysqli_query($CON, $query);
        if($result){
            $smsg = "Project Created Successfully.";
        }else{
            $fmsg ="Project Creation Failed";

        }
    }

    ?>

<div class="imagebg"></div>
<div class="row " style="margin-top: 50px">
    <div class="col-md-6 col-md-offset-3 form-container">
        <h2>PROJECT CREATION</h2>

        <form role="form" method="post" id="reused_form">
            <div class="row">
                <div class="col-sm-12 form-group">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">

                    <textarea class="form-control" type="textarea" name="PROJECT_BRIEF" id="PROJECT_BRIEF" placeholder="PROJECT DETAILS...." maxlength="6000" rows="7"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="PROJECT_LEADER">
                        Project Leader:</label>
                    <input type="text" class="form-control" id="PROJECT_LEADER" name="PROJECT_LEADER" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="PROJECT_EMAIL">
                        Email:</label>
                    <input type="email" class="form-control" id="PROJECT_EMAIL" name="PROJECT_EMAIL" required>
                </div>
            </div>
                        <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-warning btn-block" >Submit</button>
                </div>
            </div>

        </form>
        <div id="success_message" style="width:100%; height:100%; display:none; ">
            <h3>PROJECT CREATED!</h3>
        </div>
        <div id="error_message"
                style="width:100%; height:100%; display:none; ">
                    <h3>Error</h3>
                    SORRY THERE WAS AN ERROR CREATING YOUR PROJECT.

        </div>
    </div>
</div>

<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
