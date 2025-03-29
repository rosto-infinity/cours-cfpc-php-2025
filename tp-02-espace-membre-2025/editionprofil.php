<?php 
session_start();
require_once "database.php";
if(isset($_SESSION['id']) AND $_SESSION['id']>0){ 
    $requser = $pdo->prepare('SELECT * FROM membres WHERE id =?');
    $requser->execute([$_SESSION['id']]);
    $user = $requser->fetch();
    // echo "<pre>";
    // var_dump($user);
    // echo "</pre>";
    if(!empty($_POST['newpseudo']) && $_POST['newpseudo'] !== $user['pseudo']){
        $newpseudo =htmlspecialchars($_POST['newpseudo']);
        if(strlen($newpseudo) < 255){
            $reqpseudo = $pdo->prepare("SELECT *FROM membres  WHERE pseudo = ?");
            $reqpseudo ->execute([$newpseudo]);

            $pseudoexist = $reqpseudo->rowCount();
            if($pseudoexist == 0){
                $requpdate = $pdo->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
                $requpdate->execute([$newpseudo, $_SESSION['id']]);
                $_SESSION['pseudo'] = $newpseudo;
                header("Location: profil.php?id=".$_SESSION['id']);

            }else{
                $erreur = "Ce pseudo est déjà utilisé !";
            }     
          
        }else{
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    
    } 

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TUTO PHP</title>
  <meta charset="utf-8">

  <head>
    <title>TUTO PHP</title>
    <meta charset="utf-8">
  </head>

<body>
  <div align="center">
    <h2>Edition de mon profil</h2>
    <?php
if (isset($erreur)) {
echo '<font color="red">' . $erreur . "</font>";
}
?>
    <div align="left">
      <form method="POST" action="" enctype="multipart/form-data">
        <label>Pseudo :</label>
        <input type="text" name="newpseudo" placeholder="Pseudo" value="<?= $user['pseudo'];?>" /><br /><br />
        <label>Mail :</label>
        <input type="text" name="newmail" placeholder="Mail" value="<?= $user['mail'];?>" /><br /><br />
        <label>Mot de passe :</label>
        <input type="password" name="newmdp1" placeholder="Mot de passe" /><br /><br />
        <label>Confirmation - mot de passe :</label>
        <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
        <label for="">Avatar :</label>
        <input type="file" name="avatar" /><br /><br />
        <input type="submit" value="Mettre à jour mon profil !" />
      </form>
      <?php if (isset($msg)) {
        echo $msg;
      } ?>
    </div>
  </div>
</body>

</html>