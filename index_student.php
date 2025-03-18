<?php
require_once "database/database.php";
//Requete sql
$sql="SELECT *FROM student";
//Preparer notre requete
$request=$pdo->prepare($sql);
//executer notre requete
$request->execute();
// $result=$request->fetchAll();
$result=$request->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index Student</title>
  <style>
  table {
    border-collapse: collapse;
    width: 50%;
  }

  th,
  td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }
  </style>
</head>

<body>
  <?php if (count($result) > 0): ?>
  <table>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Mail</th>
      <th>Password</th>
    </tr>
    <?php foreach ($result as $row) : ?>
    <tr>
      <td><?= $row['id']; ?></td>
      <td><?=$row['nom']; ?></td>
      <td><?=$row['prenom']; ?></td>
      <td><?=$row['mail']; ?></td>
      <td><?=$row['password']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php else: ?>
  <p>Aucun résultat trouvé.</p>
  <?php endif; ?>
</body>

</html>