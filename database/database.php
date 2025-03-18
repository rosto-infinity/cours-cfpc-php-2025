<?php
$hostname="127.0.0.1";
$username ="root";
$password="";
$database="cours-cfpc-php-2025";

$connect= new mysqli($hostname,$username, $password, $database);

// if ($connect->connect_error) {
//   echo "Erreur : La connexion à la base de données a échoué :  .$connect->connect_error "
//   ;
// } else {
//   echo "Succès : Connexion à la base de données avec succès !";
// }
try {
  $conn = new mysqli($hostname, $username, $password, $database);
    
  if ($connect->connect_error) {
      throw new Exception("La connexion à la base de données a échoué : " . $connect->connect_error);
  }

  echo "Succès : Connexion à la base de données établie avec succès !";
} catch (Exception $e) {
  echo "Erreur : " . $e->getMessage();
}