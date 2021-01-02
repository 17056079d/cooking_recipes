<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'cooking_recipes';
$conn = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>
