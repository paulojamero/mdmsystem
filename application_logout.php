<?php 
session_start();


unset($_SESSION['RefLogin']);
unset($_SESSION['ApplicantType']);
session_destroy();

echo header("Location: login.php");


?>