<?php 
session_start();

unset($_SESSION['RefLogin']);

echo header("Location: login.php");


?>