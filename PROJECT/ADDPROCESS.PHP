<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Template</title>
<link rel="stylesheet" type="text/css" href="STYLES/stylesheet.css">
<style>
/*Picture wont float right?*/

#stockpic

{

    float:right;

}

</style>

</head>



<body>

<div class="Header">

	<h1>The Corral Project</h1>

</div>



<div class="navbar">

	<a href="#Home">Home</a>

	<a href="#Projects">Projects</a>

	<a href="#Conatacts">Contacts</a>

	<a href="#About Us">About Us</a>

	<div class="dropdown">

		<button class="dropbtn">Login

			<i class="fa fa-caret-down"></i>

		</button>

		<div class="dropdown-content">

			<a href="#Students">Students</a>

			<a href="#Teachers">Teachers</a>

		</div>

	</div>

</div>



<div id="contents">

  <h2>Add New Project</h2>
<?php

    $title=$_POST['title'];
    $brief=$_POST['brief'];
    $leader=$_POST['leader'];
    $email=$_POST['email'];
    $status="current";
    if(empty($brief)){
        echo "<p>you need to input project brief</p>";
    }else{

        $conn=mysqli_connect('LOCALHOST', 'ADMIN', 'PASSWORD1') or die(mysqli_errno($conn));
        mysqli_select_db($conn, 'CORRAL_PROJECT');

        $sql="insert into project (PROJECT_TITLE,PROJECT_BRIEF,PROJECT_LEADER, PROJECT_EMAIL, PROJECT_STATUS) values('$title','$brief','$leader', '$email', '$status')";

        $b=mysqli_query($conn,$sql);

         if(!$b){
                echo "<p>fail</p>";
          }else{
                if(mysqli_affected_rows($conn)>0){
                    echo "<p>success</p>";
                }else{
                    return "<p>not affected rows</p>";
                }
            }

        mysqli_close($conn);
    }

?>



</div>


<hr>

<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
