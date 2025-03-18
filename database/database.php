<?php
$hostname="127.0.0.1";
$username ="root";
$password="";
$database="cours-cfpc-php-2025l";

$connect= new mysqli($hostname,$username, $password, $database);

if ($connect->connect_error) {
  echo "Erreur : La connexion à la base de données a échoué :  .$connect->connect_error "
  ;
} else {
  echo "Succès : Connexion à la base de données avec succès !";
}