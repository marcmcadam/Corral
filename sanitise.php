<?php
require_once "connectdb.php";
//SANITISATION FUNCTIONS
function SanitiseGeneric($input, $CON) {
 $input = mysqli_real_escape_string($CON,$input);
 //dont want commas breaking the csv output fn
 $input = preg_replace("/[,]+/", "", $input);
 $input = strip_tags($input);
 $input = trim($input);
 return $input;
}

function SanitiseEmail($input, $CON) {
 $input = mysqli_real_escape_string($CON,$input);
 $input = preg_replace("/[,]+/", "", $input);
 $input = strip_tags($input);
 $input = trim($input);
 $input = strtolower($input);
 return $input;
}

function SanitiseString($CON, $input){
	$input = mysqli_real_escape_string($CON,$input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  return $input;
}

function SanitiseName($CON, $input){
  $input = mysqli_real_escape_string($CON,$input);
  $input = preg_replace("/[,]+/", "", $input);
  $input = strip_tags($input);
	$input = trim($input);
  $input = strtolower($input);
  $input = ucfirst($input);
  return $input;
}
?>
