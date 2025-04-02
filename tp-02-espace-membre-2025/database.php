<?php
$dsn = 'mysql:host=127.0.0.1;dbname=tp-02-espace-membre-2025';
$username = 'root';//username 
$password = ''; //password
$options = [];

try {
  $pdo= new PDO($dsn, $username, $password, $options);
  //options
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
die("erreur". $e->getMessage());
}