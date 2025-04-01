<?php  
session_start();

$_SESSION =[]; // 01-Détruit toutes les variables de session
session_destroy(); // 02-Détruit la session
header('Location: connexion.php');