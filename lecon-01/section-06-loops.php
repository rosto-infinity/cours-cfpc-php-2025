<?php
// ===================================================
// 2. Boucles
// ===================================================

// 02-1Boucle while
$counter = 0;
while ($counter < 5) {
    echo "While loop counter: $counter<br>";
    $counter++;
}

// 03-Boucle do-while
$counter = 0;
do {
    echo "Do-while loop counter: $counter<br>";
    $counter++;
} while ($counter < 5);

// 004--Boucle for
for ($i = 0; $i < 5; $i++) {
    echo "For loop counter: $i<br>";
}

// Boucle foreach sur tableau indexé
$fruits = ["🍍", "🍌", "🌸", "🍎"];
foreach ($fruits as $fruit) {
    echo "Fruit : $fruit<br>";
}

// Boucle foreach sur tableau associatif
$personDetails = [
    'firstName'  => 'Owen',
    'lastName'   => 'Eva',
    'age'        => 25,
    'occupation' => 'Developer'
];
foreach ($personDetails as $key => $value) {
    echo "$key: $value<br>";
}