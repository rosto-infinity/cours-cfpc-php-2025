<?php
$hostname="127.0.0.1";
$database="tp-01-crud-student";
$dsn="mysql:host=$hostname;dbname=$database";
$username ="root";
$password="";

try {
  $pdo= new PDO($dsn,$username, $password);
  echo "Succès : Connexion à la base de données avec succès !";
} catch (Exception $e) {
  echo "Erreur : " . $e->getMessage();
}