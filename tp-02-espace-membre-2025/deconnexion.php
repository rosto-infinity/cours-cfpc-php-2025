<?php  
session_start();

$_SESSION =[]; // 01-Détruit toutes les variables de session
session_destroy(); // Détruit la session
header('Location: connexion.php');