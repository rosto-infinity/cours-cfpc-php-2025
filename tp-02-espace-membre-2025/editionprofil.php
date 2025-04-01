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
  <!-- Intégration de Tailwind CSS v4 -->
  <link rel="stylesheet" href="src/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50">
  <div class="flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
      <h2 class="text-2xl font-bold text-green-700 text-center mb-6">Edition de mon profil</h2>
      <?php
      if (isset($erreur)) {
        echo '<p class="text-red-500 text-center mb-4">' . $erreur . '</p>';
      }
      ?>
      <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label for="newpseudo" class="block text-green-700 font-medium">Pseudo :</label>
          <input type="text" id="newpseudo" name="newpseudo" placeholder="Pseudo" value="<?= $user['pseudo'];?>"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label for="newmail" class="block text-green-700 font-medium">Mail :</label>
          <input type="text" id="newmail" name="newmail" placeholder="Mail" value="<?= $user['mail'];?>"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label for="newmdp1" class="block text-green-700 font-medium">Mot de passe :</label>
          <input type="password" id="newmdp1" name="newmdp1" placeholder="Mot de passe"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label for="newmdp2" class="block text-green-700 font-medium">Confirmation - mot de passe :</label>
          <input type="password" id="newmdp2" name="newmdp2" placeholder="Confirmation du mot de passe"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label for="avatar" class="block text-green-700 font-medium">Avatar :</label>
          <input type="file" id="avatar" name="avatar" class="w-full text-green-700">
        </div>
        <div>
          <input type="submit" value="Mettre à jour mon profil !"
            class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition-colors">
        </div>
      </form>
      <?php if (isset($msg)) { echo '<p class="mt-4 text-green-700 text-center">' . $msg . '</p>'; } ?>
    </div>
  </div>
</body>

</html>