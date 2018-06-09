<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="../STYLES/stylesheet.css">
</head>

<body>
<div class="Header">
</div>

<div class="navbar">
	<a href="../PAGES/HOME">Home</a>
	<a href="../ACCESS/REGISTER">Register</a>
	<a href="../PAGES/CONTACT">Contacts</a>
	<a href="../PAGES/ABOUTUS">About Us</a>
	<div class="dropdown">
		<button class="dropbtn">Login
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<a href="../Access/login">Students</a>
			<a href="../ACCESS/stafflogin">Staff</a>
		</div>
	</div>
</div>

<div id="contents">
<h2>Contact Us</h2>
<p>Although the Corral is designed to make communcation between team members and employers/teachers more efficient when dealing with group projects, we understand that some individuals might still want some questions answered. If you do have any questions, please first check out our 'About Us' page as we do have a frequently asked questions section.</p>

<hr>
<h2>Tell Us What You Think!</h2>
<p>Do you have a question that we didn't talk about in our FAQ section or would you like to give us some feedback? Insert your details below and we will get back to you as soon as possible!</p>
<form action="../PAGES/SUCCESSFULCONTACT.php" method="post">
  <p>
    <input name="name" type="text" placeholder="Please Enter Your Full Name" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <input name="email" type="email" placeholder="Please Enter Your Email Address" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <input name="subject" type="text" placeholder="Please Enter The Subject" size="30" id="ip2" required="required"/>
  </p>
  <p>
    <textarea name="message" cols="60" rows="12" id="ip3" placeholder="Please Place Your Message Here" required="required" maxlength="600"></textarea>
  </p>
  <p>
    <input type="submit" name="SEND" id="SEND" value="SEND MESSAGE" />
  </p>
</form>

<div class="Footer">
	© Copyright Deakin University & Group 29 2018
</div>
</body>
</html>
