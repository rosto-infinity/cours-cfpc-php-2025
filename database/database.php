<?php
$hostname="127.0.0.1";
$database="cours-cfpc-php-2025";
$dsn="mysql:host=$hostname;dbname=$database";
$username ="root";
$password="";

try {
  $connect= new PDO($dsn,$username, $password);
  echo "Succès : Connexion à la base de données avec succès !";
} catch (Exception $e) {
  echo "Erreur : " . $e->getMessage();
}