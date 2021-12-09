<?php 
session_start();
include 'bdd.php';
unset($_SESSION['username']);
setcookie("username", "", 0);
header("Location: connexion.php");
?>