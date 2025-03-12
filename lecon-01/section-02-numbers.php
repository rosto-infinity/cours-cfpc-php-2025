<?php
// 1. Déclaration de nombres
$a = 5;
echo $a;
$b = 4;
$c = 1.2;
echo "Addition" .($a + $b) . "<br>";

echo "Soustraction" .($a - $b) . "<br>";
echo "Multiplication" .($a * $b) . "<br>";
echo "Division" .($a / $c) . "<br>";
echo "Modulo" .($a % $b) . "<br>";

// Nouveauté PHP 8.x : fdiv() permet de diviser en gérant correctement les cas de division par zéro
echo "Division flottante avec fdiv : " . fdiv($a, $c) . '<br>';