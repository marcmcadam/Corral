<?php
session_start();
session_regenerate_id();  // prevention of session hijacking
session_unset();
session_destroy();
header('Location: login.php');
?>
