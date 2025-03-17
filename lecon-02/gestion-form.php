<?php
 session_start();

if (isset($_POST['create'])) {
  $nom_student = htmlspecialchars($_POST["nom"]);
  $prenom_student = htmlspecialchars($_POST["prenom"]);

  
  if (empty($_POST['nom'])) {
    echo "Le nom est obligatoire <br>";
  } else {
      echo "Nom: $nom_student <br>";
  } 
  if (empty($_POST['password'])) {
    echo "Le password est obligatoire <br>";
  } else {
    $password_student = htmlspecialchars($_POST['password']) ;
    $motDePasseHash = password_hash($password_student, PASSWORD_DEFAULT);
    
      echo "password: $motDePasseHash <br>";
  } 

}

?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
</head>

<body>
  <form action="gestion-form.php" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">
    <div class="mb-4">
      <input type="text" name="nom" placeholder="Nom" value="<?= $nom_student ?? "" ?>"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
    </div>
    <div class="mb-4">
      <input type="text" name="prenom" value="<?= $prenom_student ?? "" ?>" placeholder="Prénom" class="" w-full border
        border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
    </div>
    <div class="mb-4">
      <input type="text" name="mail" placeholder="Email"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
    </div>
    <div class="mb-4">
      <input type="password" name="password" placeholder="password"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
    </div>
    <!-- texte centre -->
    <div class="text-center">
      <input type="submit" name="create" value="Créer"
        class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
      <button href="http: //localhost/php-2025/cours-php/cours-cfpc-php-2025/lecon-02/gestion-form.php"
        class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"> Refresh</button>
    </div>
  </form>

</body>

</html>