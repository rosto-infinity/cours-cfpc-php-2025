<?php  
session_start();

$_SESSION =[]; // Détruit toutes les variables de session
session_destroy(); // Détruit la session
header('Location: connexion.php');