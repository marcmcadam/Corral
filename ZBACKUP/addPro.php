<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Add Project</title>

<style>

body {

  padding-bottom: 40px;

  background-color: #eee;

}

.form-signin {

  max-width: 330px;

  padding: 15px;

  margin: 0 auto;

}

.form-signin .form-signin-heading,

.form-signin .checkbox {

  margin-bottom: 10px;

}

.form-signin .checkbox {

  font-weight: normal;

}

.form-signin .form-control {

  position: relative;

  height: auto;

  -webkit-box-sizing: border-box;

     -moz-box-sizing: border-box;

          box-sizing: border-box;

  padding: 10px;

  font-size: 16px;

}

.form-signin .form-control:focus {

  z-index: 2;

}

.form-signin input[type="email"] {

  margin-bottom: -1px;

  border-bottom-right-radius: 0;

  border-bottom-left-radius: 0;

}

.form-signin input[type="password"] {

  margin-bottom: 10px;

  border-top-left-radius: 0;

  border-top-right-radius: 0;

}

.Header {

	background-color: #333;

	font-family: Arial, Helvetica, sans-serif;

	color: white;

	text-align: center;

	padding: 5px;

}

.Footer {

	padding: 20px;

	background-color: #333;

	color: white;

	text-align: center;

	font-family: Arial, Helvetica, sans-serif;

}

p {

	margin-left: 40px;

	margin-right: 50px;

	font-family: Arial, Helvetica, sans-serif;

}

h2 {

	margin-left: 40px;

	font-family: Arial, Helvetica, sans-serif;

}

/* The navagation bar for the site, linked to the drop downs */

	.navbar {

    overflow: hidden;

    background-color: #333;

    font-family: Arial, Helvetica, sans-serif;

}

.navbar a {

    float: left;

    font-size: 16px;

    color: white;

    text-align: center;

    padding: 14px 100px;

    text-decoration: none;

}

/* This is for the drop down in the navigation bar */

.dropdown {

    float: left;

    overflow: hidden;

}

.dropdown .dropbtn {

    font-size: 16px;

    border: none;

    outline: none;

    color: white;

    padding: 14px 16px;

    background-color: inherit;

    font-family: inherit;

    margin: 0;

}

.navbar a:hover, .dropdown:hover .dropbtn {

    background-color: red;

}

.dropdown-content {

    display: none;

    position: absolute;

    background-color: #f9f9f9;

    min-width: 160px;

    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

    z-index: 1;

}

.dropdown-content a {

    float: none;

    color: black;

    padding: 12px 16px;

    text-decoration: none;

    display: block;

    text-align: left;

}

.dropdown-content a:hover {

    background-color: #ddd;

}

.dropdown:hover .dropdown-content {

    display: block;

}

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


<div id="contents" >
<h2>Add New Project</h2>
<form action="addProcess.php" method="post">
<p>Project Brief</br></p>
<p><textarea name="brief" rows="5" cols="40"></textarea></br></p>
<p><input type="submit" value="add">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>

<hr>
<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
