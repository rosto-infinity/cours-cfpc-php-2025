<?php
// 1. 01Déclaration de nombres
$a = -5;
echo $a;
$b = 4;
$c = 1.2;
echo "Addition" .($a + $b) . "<br>";

$d=0;
echo "Soustraction" .($a - $b) . "<br>";
echo "Multiplication" .($a * $b) . "<br>";
echo "Division" .($a / $c) . "<br>";
echo "Modulo" .($a % $b) . "<br>";


// Nouveauté PHP 8.x : fdiv() permet de diviser en gérant correctement les cas de division par zéro
echo "Division flottante avec fdiv : " . fdiv($a, $d) . '<br>';
// 3. Opérateurs d'assignation arithmétique
$a += $b; // équivaut à $a = $a + $b;
echo "Après addition, $a = $a<br>";
$a -= $b; // équivaut à $a = $a - $b;
echo "Après soustraction, \$a = $a<br>";
$a *= $b; // équivaut à $a = $a * $b;
echo "Après multiplication, \$a = $a<br>";
$a /= $b; // équivaut à $a = $a / $b;
echo "Après division, \$a = $a<br>";
$a %= $b; // équivaut à $a = $a % $b;
echo "Après modulo, \$a = $a<br>";

// 4. Opérateurs d'incrémentation

$a = 75;
$b=8;
echo "Post-incrément (\$a++): " . $a++ . '<br>'; // Affiche 5, puis $a devient 6

echo " \$a =" .  $a. '<br>';

echo "Pré-incrément (++\$b): " . ++$b . '<br>';  // Incrémente à 7 puis affiche 7

echo " \$b =" . $b.  '<br>';
// 5. Opérateurs de décrémentation

echo "Post-décrément (\$a--): " . $a-- . '<br>'; // Affiche 7, puis $a devient 6
echo "Pré-décrément (--\$a): " . --$a . '<br>';  // Décrémente à 5 puis affiche 5



$strNumber = '12.34';
$number = (float)$strNumber; // Ou utiliser floatval($strNumber)

floatval($strNumber);
var_dump($number);
echo '<br>';

// 8. Fonctions mathématiques
echo "abs(-15) : " . abs(-15) . '<br>';
echo "pow(2, 3) : " . pow(2, 3) . '<br>';
echo "sqrt(16) : " . sqrt(16) . '<br>';
echo "max(2, 3) : " . max(2, 3) . '<br>';
echo "min(2, 3) : " . min(2, 3) . '<br>';
echo "round(2.4) : " . round(2.4) . '<br>';
echo "round(2.6) : " . round(2.6) . '<br>';
echo "floor(2.6) : " . floor(2.6) . '<br>';
echo "ceil(2.4) : " . ceil(2.4) . '<br>';

// 9. Formatage des nombres
$nombre = 123456789.12345;

// Utilisation des arguments nommés (une nouveauté de PHP 8.x) pour une meilleure lisibilité
$nombre = 1234.56;
echo number_format(
    num: $nombre,
    decimals: 2,
    decimal_separator: '.',
    thousands_separator: ','
) . '<br>';
?>