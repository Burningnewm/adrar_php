<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=eval_mythologie;charset=utf8", "root", "root");
} catch (Exception $e) {
    die($e->getMessage());
}