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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="src/output.css" rel="stylesheet">
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
            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?= $pseudo  ?? ''?>" /
              autocomplete="off">


          </td>
        </tr>
        <tr>
          <td align=" right">
            <label for="mail">Mail :</label>
          </td>
          <td>
            <input type="mail" placeholder="Votre mail" value="<?= $mail  ?? ''?>" id="mail" name="mail"
              autocomplete="off" />
          </td>
        </tr>
        <tr>
          <td align="right">
            <label for="mail2">Confirmation du mail :</label>
          </td>
          <td>

            <input type="mail" value="<?= $mail  ?? ''?>" placeholder="Confirmez votre mail" id="mail2" name="mail2"
              autocomplete="off" />

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