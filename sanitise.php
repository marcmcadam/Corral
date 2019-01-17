<?php
require_once "connectdb.php";
//SANITISATION FUNCTIONS
function SanitiseInput($input, $CON ){
  $input = trim($input);
  $input = strip_tags($input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = mysqli_real_escape_string($CON,$input);
  return $input;
}


//left just incase a rogue function remains
function SanitiseGeneric($input, $CON){
 SanitiseInput($input, $CON);
 return $input;
}

function SanitiseEmail($input, $CON) {
  SanitiseInput($input, $CON);
  return $input;
}

function SanitiseString($CON, $input){
	SanitiseInput($input, $CON);
  return $input;
}

function SanitiseName($CON, $input){
  SanitiseInput($input, $CON);
  return $input;
}


?>
