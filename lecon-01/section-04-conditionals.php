<?php
// ===================================================
// 1. Conditionnelles et opérateurs ternaires
// ===================================================

$age=10;
$salary = 450000;

//1- Opérateur ternaire simple
echo $age < 22 ? 'Young' : 'Old'; // Affiche "Old" car 25 n'est pas inférieur à 22
echo '<br>';

// 2-Opérateur ternaire imbriqué
echo $age < 22 ? ($age < 16 ? 'Too young' : 'Young') : 'Old';
echo '<br>';

// 03-Opérateur ternaire court (Null coalescing pour la vérification de variable)
$myAge = $age ? : 18; // Si $age est évalué à false, 18 est assigné
echo "myAge = $myAge<br>";

// Opérateur de fusion null
$name = null;
$displayName = $name ?? 25888;
echo "Name:------ " . $displayName . '<br>';

// Opérateur de fusion null-assignment (depuis PHP 7.4)
$person = [
    'name'  // Si cette clé était absente, on lui assignerait "Anonymous"
];
$per = ['a', 12, true];
echo "<pre>"; 

echo "</pre>";
var_dump($per);
echo "<pre>";


echo "</pre>";
print_r($per);
echo "<pre>";




$person['name'] ??= 'Anonymous';
echo "Person name: " . $person['name'] . '<br>';

// Switch statement avec mise à jour des rôles
$userRole = 'editor'; // Valeurs possibles: 'admin', 'editor', 'user'
switch ($userRole) {
    case 'admin':
        echo 'You have full access.<br>';
        break;
    case 'editor':
        echo 'You can edit content.<br>';
        break;
    case 'user':
        echo 'You can view posts and comment.<br>';
        break;
    default:
        echo 'Unknown role.<br>';
        break;
}