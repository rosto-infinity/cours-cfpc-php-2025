<?php
// 1. Déclaration de nombres
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

$a = 5;
echo "Post-incrément (\$a++): " . $a++ . '<br>'; // Affiche 5, puis $a devient 6
echo "Pré-incrément (++\$a): " . ++$a . '<br>';  // Incrémente à 7 puis affiche 7
// 5. Opérateurs de décrémentation

echo "Post-décrément (\$a--): " . $a-- . '<br>'; // Affiche 7, puis $a devient 6
echo "Pré-décrément (--\$a): " . --$a . '<br>';  // Décrémente à 5 puis affiche 5