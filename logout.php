<?php 
session_start();
$_SESSION["login"];
$_SESSION["username"];

unset($_SESSION["login"]);
unset($_SESSION["username"]);

session_unset();
session_destroy();

header("location:index.php?logout")

?>