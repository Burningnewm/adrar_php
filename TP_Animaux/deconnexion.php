<?php 
session_start();
include 'bdd.php';
unset($_SESSION['username']);
header("Location: connexion.php");
?>