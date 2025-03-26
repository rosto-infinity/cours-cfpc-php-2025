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

    
  }
  $error = register($pseudo, $mail, $mail2, $mdp ,$mdp2);
}

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div align="center">
    <h2>Inscription prof</h2>
    <br /><br />
    <form method="POST" action="">

      <?php 
      if(isset($error)){
        echo "<p style='background:red; width:300px; color:white; padding:12px;'>".$error."</p>";
      }
      ?>

      <table>
        <tr>
          <td align="right">
            <label for="pseudo">Pseudo :</label>
          </td>
          <td>
            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" />

          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="mail">Mail :</label>
          </td>
          <td>
            <input type="text" placeholder="Votre mail" id="mail" name="mail" />
          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="mail2">Confirmation du mail :</label>
          </td>
          <td>
            <input type="text" placeholder="Confirmez votre mail" id="mail2" name="mail2" />
          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="mdp">Mot de passe :</label>
          </td>
          <td>
            <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="mdp2">Confirmation du mot de passe :</label>
          </td>
          <td>
            <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
          </td>
        </tr>
        <tr>
          <td></td>
          <td align="center">
            <br />

            <input type="submit" name="forminscription" value="Je m'inscris" /> Déjà un compte ?<a
              href="connexion.php">Se connecter</a>
          </td>
        </tr>
      </table>
    </form>

  </div>
</body>

</html>