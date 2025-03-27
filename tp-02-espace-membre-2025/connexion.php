<?php
require_once 'database.php';

function handlePostRequest($pdo)
{

  //Verification du type de requete
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return;
  }

  //réception des données du formulaire
  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $mdpconnect = $_POST['mdpconnect'];
  if (empty($mailconnect) || empty($mdpconnect)) {
    return "Tous les champs doivent être remplis";
  }
}

function authenticateUser($pdo, $mailconnect, $mdpconnect)
{
  // vérification du mail
  $sql = "SELECT * FROM membres WHERE mail = :mailconnect";
  $reqMail = $pdo->prepare($sql);
  $reqMail->execute(compact('mailconnect'));
  $mailExist = $reqMail->fetch();
  if (!$mailExist) {
    return "Le mail n'existe pas";
  }

  // vérification du mot de passe
  if (!password_verify($mdpconnect, $mailExist['mdp'])) {
    return "Le mot de passe est incorrect";
  }
  return null;
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <title>TUTO PHP</title>
  <meta charset="utf-8">
  <link href="src/output.css" rel="stylesheet">

</head>

<body class="bg-green-100 pt-[100px] font-family-Poppins">
  <div align="center">
    <h2 class="text-4xl font-bold text-green-900 text-center mb-6">Connexion</h2>
    <br /><br />
    <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
      <label for="mail" class="">Mail :</label>
      <!-- E-mail : <input type="email" name="mailconnect" placeholder="Mail" /> <br><br> -->
      <input type="mail" placeholder="mail" id="mail" name="mailconnect"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
      <label for="pseudo" class="">Mot de passe :</label>
      <input type="password" placeholder="mot de passe" id="password" name="mdpconnect"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
      <!-- PassWord : <input type="password" name="mdpconnect" placeholder="Mot de passe" /> -->
      <br /><br />
      <input type="submit" value="Se connecter !"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100 cursor-pointer" />
    </form>
    <?php
    if (isset($erreur)) {
      echo '<font color="red">' . $erreur . "</font>";
    }
    ?>
  </div>
</body>


</html>