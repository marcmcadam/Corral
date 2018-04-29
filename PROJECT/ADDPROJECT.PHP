<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>Add Project</title>
<link rel="stylesheet" type="text/css" href="STYLES/styleform.css">
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


<div id="contents" >
<h2>Add New Project</h2>
<form action="addProcess.php" method="post">
<p>Project Title &nbsp<input type="text" name="title"/></br></p>
<p>Project Brief &nbsp<input type="text" name="brief"/></br></p>
<p>Project Leader &nbsp<input type="text" name="leader"/></br></p>
<p>Leader Email &nbsp<input type="text" name="email"/></br></p>
<p><input type="submit" value="add">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="reset" value="reset"></p>
</form>
</div>

<hr>
<div class="Footer">

	<h4>This is copyrighted by Deakin and the project group 29</h4>

</div>

</body>

</html>
