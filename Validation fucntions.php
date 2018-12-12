<?php
preg_match('/[A-Za-z0-9]*@deakin.edu.au/', $_POST['forgotemail'])



//replaces anything that isnt a-z or A-Z or 1-9 with blank
$stu_FirstName = preg_replace("/[^a-zA-Z0-9]+/", "", $stu_FirstName);

//still lets []/ characters through
if( preg_match('/[A-Za-z]/', $stu_FirstName) ){
  print "first name A O K <br>";
} else {
  print "ERROR in first name";
}

//is the best validation of text jsut sanitisation?

//definitely validate numbers and stuff
preg_match('/[0-9]{9}$/', stu_id) ){







//SANITISATION FUNCTIONS
function SanitiseGeneric($input, $CON){
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  return $input;
}
function SanitiseString($input, $CON){
	$input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  return $input;
}
function SanitiseName($input, $CON){
  $input = mysqli_real_escape_string($CON,$input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  $input = ucfirst($input);
  return $input;
}

?>
