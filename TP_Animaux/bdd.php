<?php 
try{
    $db = new PDO("mysql:host=localhost;dbname=animaux_php;charset=utf8", "root", "root");
}catch(Exception $e){
    die($e->getMessage());
}
?>