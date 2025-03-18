<?php
require_once "database/database.php";

$sql="SELECT *FROM student";
$result=$connect->query($sql);

echo "<pre>";
var_dump($result);
echo "</pre>";
if($result->num_rows >0)
{
foreach($result as $row)
{

  echo "</br>";
  echo "Id : " .$row['id'].  "</br>";
  echo "Nom : " .$row['nom'].  "</br>";
  echo "Prenom : " .$row['prenom'].  "</br>";
  echo "Mail : " .$row['mail'].  "</br>";
  echo "Password : " .$row['password'].  "</br>";
}
}else{
  echo "Aucun résultat trouvé";
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index_student</title>
</head>

<body>

</body>

</html>