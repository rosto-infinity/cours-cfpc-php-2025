<?php
require_once "database.php";
  
  // $sql1 = "SELECT * FROM students WHERE nom LIKE :search OR prenom LIKE :search  OR mail LIKE :search ";
  
  // $sql1 = $sql. "WHERE nom LIKE :search OR prenom LIKE :search  OR mail LIKE :search ";
  
  // $sql .= "WHERE nom LIKE :search OR prenom LIKE :search  OR mail LIKE :search ";
  //prepare la requête
// initialisation de la variable de recherche

$search = isset($_GET['search']) ? $_GET['search'] : '';

// requête SQL avec filtre de recherche
// Requête SQL pour récupérer tous les students
$sql = "SELECT * FROM students";
if(!empty($search)){
  $sql .= " WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR mail LIKE '%$search%' ";
}
  $req_select = $pdo->prepare($sql);
  
//execute la requête
$req_select->execute();

//récupère les données
$donnees = $req_select->fetchAll();

//Verifie s'il ya des donnees 

if(count($donnees) >0){
  echo "Nombre d'étudiants : ".count($donnees);
}else{
  echo "Aucun étudiant trouvé";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <title>TP-01-Crud-student</title>
</head>

<body class="bg-green-100 p-12">
  <div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-green-900 text-center mb-6">CRUD student en PHP et tailwind css V4</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" action="" class="mb-4">

      <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700" href="create.php">Créer un
        nouvel étudiant</a>

      <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700"
        href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/tp-01-crud-student/">Actualiser
      </a>

      <input type=" text" name="search" placeholder="Rechercher par nom ou email" value=""
        class="my-5 px-4 py-2 border rounded-lg w-full md:w-1/3">
      <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Rechercher</button>
    </form>

    <!-- Tableau des étudiants -->
    <table class="min-w-full divide-y divide-green-200 bg-white shadow rounded-lg">
      <thead class="bg-green-200">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Nom</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Prénom</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Mail</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-green-100">
        <?php foreach ($donnees as $donnee) : ?>
        <tr class="hover:bg-green-50">
          <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
            <?= $donnee['nom']; ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
            <?php echo  $donnee['prenom']; ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900">
            <?php echo  $donnee['mail']; ?>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm">
            <a class="text-green-600 hover:text-green-900 font-medium mr-4"
              href="update.php?id=<?= $donnee['id']; ?>">Modifier</a>

            <a class="text-red-600 hover:text-red-900 font-medium" href="delete?id=<?= $donnee['id']; ?>"
              onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>


  </div>
</body>

</html>