<?php
function hello($name): void
{
  echo "Hello $name<br>";
}

hello('Owen');
function sum($a, $b): mixed
{
  return $a + $b;
}

echo sum(4, 5) . '<br>';
function sumAll(...$nums): mixed {
  return array_reduce($nums, fn($carry, $n) => $carry + $n +0);
}
echo "Sum of numbers 1,2,3,4,5: " 
. sumAll(1, 2, 3, 4, 5, 6, 7, 8, 9) 
. "<br>";