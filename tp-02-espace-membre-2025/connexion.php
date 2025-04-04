<?php
    session_start();
    require_once 'database.php';

    function handlePostRequest($pdo)
    {
        //01-Verification du type de requete
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        //02-réception des données du formulaire
        $mailconnect = htmlspecialchars($_POST['mailconnect']);
        $mdpconnect  = $_POST['mdpconnect'];
        if (empty($mailconnect) || empty($mdpconnect)) {
            return "Tous les champs doivent être remplis";
        }

        return authenticateUser($pdo, $mailconnect, $mdpconnect);
    }

    function authenticateUser($pdo, $mailconnect, $mdpconnect)
    {
        // 03-vérification du mail
        $sql     = "SELECT * FROM membres WHERE mail = :mailconnect";
        $reqMail = $pdo->prepare($sql);
        $reqMail->execute(compact('mailconnect'));
        $mailExist = $reqMail->rowCount();
        if (! $mailExist) {
            return "Le mail n'existe pas";
        }
        $userinfo = $reqMail->fetch();
        // echo "<pre>";
        // print_r($userinfo['mdp']);
        // echo "</pre>";
        // die();
        if (! password_verify($mdpconnect, $userinfo['mdp'])) {
            return 'Mauvais mot de passe';
        }

        //04-Définition des variables de session et stocker les informations de l'utilisateur
        $_SESSION['id']     = $userinfo['id'];
        $_SESSION['pseudo'] = $userinfo['pseudo'];
        $_SESSION['mail']   = $userinfo['mail'];

//02-S i l'utilisateur est authentifié, on  enregistre son rôle dans la session
      $_SESSION['role'] = $userinfo['role'];
      $_SESSION['auth'] = $userinfo;

      //Redirection selon le rôle de l'utilisateur
      switch ($_SESSION['role']) {
          case 'admin':
              header("Location: admindofjjzeee/admindofjjzeee-dashboard.php");
             break;
          case 'user':
              header("Location: profil.php?id=" . $_SESSION['id']);
              break;
          default:
              return "Rôle inconnu";
    }

}

    $erreur = handlePostRequest($pdo);
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
    <?php
        if (isset($erreur)) {
            echo "<p style='background:red; width:300px; color:white; padding:12px;'>" . $erreur . "</p>";
        }
    ?>
    <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
      <label for="mailconnect" class="">Mail :</label>
      <input type="mail" placeholder=" mailconnect" id="mailconnect" name="mailconnect" autocomplete="$off"
        value="<?php echo $mailconnect ?? ''?>"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
      <label for="mdpconnect" class="">Mot de passe :</label>
      <input type="password" placeholder="mot de passe" id="password" name="mdpconnect"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />

      <br /><br />
      <input type="submit" value="Se connecter !"
        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100 cursor-pointer" />
    </form>

  </div>
</body>


</html>