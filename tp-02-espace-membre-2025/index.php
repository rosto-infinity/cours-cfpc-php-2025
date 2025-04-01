<?php 

require_once 'database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  //réception des données du formulaire
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mail = htmlspecialchars($_POST['mail']);
  $mail2 = htmlspecialchars($_POST['mail2']);
  
  $mdp = $_POST['mdp'];
  $mdp2 = $_POST['mdp2'];
  
  function register($pseudo, $mail, $mail2, $mdp ,$mdp2){
    global $pdo;
    // vérification des champs
    if(empty($pseudo) || empty($mail) || empty($mail2) || empty($mdp) || empty($mdp2)){
      return "Tous les champs doivent être remplis";
    }

    // vérification du pseudo
    if(strlen($pseudo) > 255){
      return "Le pseudo est trop long";
    }
    $sql = "SELECT * FROM membres WHERE pseudo = :pseudo";
    $reqPseudo = $pdo->prepare($sql);
    $reqPseudo->execute(compact('pseudo'));
    $pseudoExist = $reqPseudo->fetch();
    // $pseudoExist->rowCount()>0;
    if($pseudoExist){
      return "Le pseudo est déjà utilisé";
    }
    
    // vérification du mail
    if($mail != $mail2){
      return "Les mails ne correspondent pas";
    }
   
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
      return "Le mail n'est pas valide";
    }

    
    $sql = "SELECT * FROM membres WHERE mail = :mail";
    $reqMail = $pdo->prepare($sql);
    $reqMail->execute(compact('mail'));
    $mailExist = $reqMail->fetch();
    if($mailExist){
      return "Le mail est déjà utilisé";
    }

    // vérification du mot de passe
    if(strlen($mdp<8) || !preg_match("#[0-9]+#", $mdp) || !preg_match("#[a-zA-Z]+#", $mdp) ){
      return "Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre";
    }

    if($mdp != $mdp2){
      return "Les mots de passe ne correspondent pas";
     }

    // cryptage du mot de passe
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);


    
    // insertion des données dans la base de données
    $sql = "INSERT INTO membres (pseudo, mail, mdp) VALUES (:pseudo, :mail, :mdp)";
    $req = $pdo->prepare($sql);
    $req->execute(compact('pseudo', 'mail', 'mdp'));
    return "Votre compte a bien été créé ! <a style='color:white;' href=\"connexion.php\">Me connecter</a>"; // Inscription réuss

  }
  $error = register($pseudo, $mail, $mail2, $mdp ,$mdp2);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="src/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-green-700 text-center mb-4">Inscription</h2>

    <?php if(isset($error)) : ?>
    <p class="bg-red-500 text-white text-center p-2 rounded mb-4"> <?= $error ?> </p>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-4">
        <label for="pseudo" class="block text-gray-700">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" value="<?= $pseudo ?? '' ?>"
          class="w-full p-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
      <div class="mb-4">
        <label for="mail" class="block text-gray-700">Mail :</label>
        <input type="email" id="mail" name="mail" placeholder="Votre mail" value="<?= $mail ?? '' ?>"
          class="w-full p-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
      <div class="mb-4">
        <label for="mail2" class="block text-gray-700">Confirmation du mail :</label>
        <input type="email" id="mail2" name="mail2" placeholder="Confirmez votre mail" value="<?= $mail ?? '' ?>"
          class="w-full p-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
      <div class="mb-4">
        <label for="mdp" class="block text-gray-700">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe"
          class="w-full p-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
      <div class="mb-4">
        <label for="mdp2" class="block text-gray-700">Confirmation du mot de passe :</label>
        <input type="password" id="mdp2" name="mdp2" placeholder="Confirmez votre mot de passe"
          class="w-full p-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
      <div class="flex flex-col items-center">
        <button type="submit" name="forminscription"
          class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
          Je m'inscris
        </button>
        <p class="mt-2 text-gray-600">Déjà un compte ? <a href="connexion.php" class="text-green-700 font-bold">Se
            connecter</a></p>
      </div>
    </form>
  </div>
</body>

</html>