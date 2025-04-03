<?php
// Mise à jour 2024-2025 : Opérations sur les tableaux en PHP

// ===================================================
// Tableaux indexés
// ===================================================

// 1-Création d'un tableau de fruits (nouvelles valeurs)
$fruits = ["Mango", "Strawberry", "Blueberry"];

// 2-Affichage complet du tableau
echo '<pre>';
var_dump($fruits);
echo '</pre>';

echo '<pre>';
print_r($fruits);
echo '</pre>';

// 4-Accès à un élément par index (affiche "Strawberry")
echo $fruits[1] . '<br>';

// 5-Modification d'un élément par index
$fruits[0] = "Peach";

// 6-Vérification de l'existence d'un élément à l'index 2
echo '<pre>';
var_dump(isset($fruits[3]));
echo '</pre>';

// 7-Ajout d'un élément à la fin du tableau
$fruits[] = "Kiwi";
echo $fruits[3] . '<br>';

// Affichage de la longueur du tableau
echo count($fruits) . '<br>';

// Ajout d'un élément à la fin du tableau avec array_push et suppression du dernier élément avec array_pop
array_push($fruits, "Dragonfruit");
array_pop($fruits);

echo '<pre>';
var_dump($fruits);
echo '</pre>';

// Ajout d'un élément en début de tableau avec array_unshift et suppression du premier élément avec array_shift
array_unshift($fruits, "Apple");
array_shift($fruits);

// Conversion d'une chaîne en tableau
$string = "Mango,Strawberry,Peach+++++++++++++++++++";
echo '<pre>';
var_dump(explode(",", $string));
echo '</pre>';

// Affichage du tableau avec print_r
print_r($fruits);

// Combinaison des éléments du tableau en une chaîne
echo implode(",", $fruits) . '<br>';

// Vérification de l'existence d'un élément dans le tableau
echo '<pre>';
var_dump(in_array("Apple", $fruits));
echo '</pre>';

// Recherche de l'index d'un élément dans le tableau
echo '<pre>';
var_dump(array_search("Peach", $fruits));
echo '</pre>';

// Fusion de deux tableaux
$vegetables = ["Potato", "Cucumber"];
echo '<pre>';
var_dump(array_merge($fruits, $vegetables));
var_dump([...$fruits, ...$vegetables]); // Utilisation de l'opérateur spread (depuis PHP 7.4)
echo '</pre>';

// Tri du tableau (ordre croissant)
sort($fruits);
echo '<pre>';
var_dump($fruits);
echo '</pre>';

// Utilisation des fonctions filter, map et reduce
$numbers = [1, 2, 3, 4, 5, 6, 7, 8];

// Filtrer les nombres pairs
$evens = array_filter($numbers, fn($n) => $n % 2 === 0);
echo '<pre>';
var_dump($evens);
echo '</pre>';

// Ajouter 1 à chaque élément
$squares = array_map(fn($n) => $n + 1, $numbers);
echo '<pre>';
var_dump($squares);
echo '</pre>';

// Calculer la somme des éléments
$sum = array_reduce($numbers, fn($carry, $item) => $carry + $item);
echo $sum . '<br>';

// ===================================================
// Tableaux associatifs
// ===================================================

// Création d'un tableau associatif pour une personne
$person = [
    'name'     => 'Owen',
    'surname'  => 'Eva',
    'location' => 'Paris',
    'hobbies'  => ['Cycling', 'Photography'],
];

// Accès à un élément par clé (affiche "Owen")
echo $person['name'] . '<br>';

// Ajout d'une nouvelle clé-valeur
$person['channel'] = 'OwenEvaChannel';

// Vérification de l'existence d'une clé spécifique
echo '<pre>';
var_dump(isset($person['location']));
echo '</pre>';

// Affichage des clés du tableau
echo '<pre>';
var_dump(array_keys($person));
echo '</pre>';

// Affichage des valeurs du tableau
echo '<pre>';
var_dump(array_values($person));
echo '</pre>';

// Tri du tableau associatif par clé
ksort($person);
echo '<pre>';
var_dump($person);
echo '</pre>';

// ===================================================
// Tableaux multidimensionnels
// ===================================================

$todoItems = [
    ['title' => 'Acheter du lait',    'completed' => true],
    ['title' => 'Faire du sport',       'completed' => false],
];

echo '<pre>';
var_dump($todoItems);
echo '</pre>';
?>