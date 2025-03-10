<?php 
// Variables
$nom = "owen"; // Chaine de caractères (string)
echo "<pre>";
var_dump($nom); 
echo "</pre>";

$age = 14;
echo "<pre>";
var_dump($age); 
echo "</pre>";

$isMale = true;       // Booléen
var_dump($isMale); 

$taille = 1.80; // Nombre à virgule (float)
echo gettype($taille) . '<br>'; 

$revenu = null; // Valeur nulle
echo gettype($revenu). '<br>';

echo "<pre>";
var_dump($nom,  $age, $isMale, $taille, $revenu);
echo "</pre>";

$nom = 0;
echo is_int($nom);

echo is_int($age) ? 'age est un entier<br>' : 'age n\'est pas un entier<br>';
echo is_bool($isMale) ? 'isMale est un booléen<br>' : 'isMale n\'est pas un booléen<br>';
echo is_float($taille) ? 'taille est un float<br>' : 'taille n\'est pas un float<br>';

echo "Nom 2 : $nom, Âge : $age<br>";