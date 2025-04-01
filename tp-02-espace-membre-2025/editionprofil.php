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

    //01-mise a jour de l'email
    if(!empty($_POST['newmail']) && $_POST['newmail'] !== $user['mail']){
        $newmail = htmlspecialchars($_POST['newmail']);
        if(filter_var($newmail, FILTER_VALIDATE_EMAIL)){
            $reqmail = $pdo->prepare("SELECT *FROM membres  WHERE mail = ?");
            $reqmail ->execute([$newmail]);

            $mailexist = $reqmail->rowCount();
            if($mailexist == 0){
                $requpdate = $pdo->prepare("UPDATE membres SET mail = ? WHERE id = ?");
                $requpdate->execute([$newmail, $_SESSION['id']]);
                $_SESSION['mail'] = $newmail;
                header("Location: profil.php?id=".$_SESSION['id']);

            }else{
                $erreur = "Cet email est déjà utilisé !";
            }     
          
        }else{
            $erreur = "Votre email n'est pas valide !";
        }
    
    }

    //Mise a jour du mdp

    if(!empty($_POST['newmdp1']) && !empty($_POST['newmdp2'])){
        if($_POST['newmdp1'] === $_POST['newmdp2']){
            $newMdp = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
            $requpdate = $pdo->prepare("UPDATE membres SET mdp = ? WHERE id = ?");
            $requpdate->execute([$newMdp, $_SESSION['id']]); 
         }else{
                $erreur = "Vos mots de passe ne correspondent pas !";
            } 
    }else{
        $erreur = "Veuillez remplir  les champs mot de passe !";
    }



    /** 
     * Mise de l'avatar 
      * 1 - Verification de l'upload de l'image
      * 2 - Verification de la taille de l'image
      * 3 - Verification de l'extension de l'image est autorisé
      * 4 - Renommer l'image uploadée (id de l'user 'extension de l'image)
      * 5 - Chemin de destination pour l'upload de l'image
      * 6 - Deplacement de l'image uploadée vers le dossier de destination
     * 
     * */

     //1-Verification de la présence d'un fichier uploadé
     if(!empty($_FILES['avatar']['name'])){
        $maxIze= 2*1024*1024; // 2Mo 
        //Taableau des extensions autorisées
        $validExt = ['jpg', 'jpeg', 'gif', 'png'];

        //2-Verification de la taille de l'image
        if($_FILES['avatar']['size'] <= $maxIze){
          //Recuperation de l'extension du fichier
          $ext =strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
          //3-Verification de l'extension du fichier est autorisée
             if(in_array($ext,$validExt)){
              //03+Renommer l'image uploadée (id de l'utilisateur. l'extension de l'image) 
              $newFilename = $_SESSION['id'] . "." .$ext;
              //4- Chemin de destination pour l'upload de l'image
             $destination ="membres/avatars/" .$newFilename; 
             
             // 5-Deplacement de l'image uploadée vers le dossier de destination
             if(move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)){
                $requpdate = $pdo->prepare("UPDATE membres SET avatar = ? WHERE id = ?");
                $requpdate->execute([$newFilename, $_SESSION['id']]); 
                header("Location: profil.php?id=".$_SESSION['id']);
                exit();
              }else{
                //Erreur lors de l'upload de l'imag
                $erreur = "Erreur lors de l'upload de l'image !";
              }
                
             } else{
              // "Format d'image non autorisé ( 'jpg', 'jpeg', 'gif', 'png' requis)!"
               $erreur = "Format d'image non autorisé ( 'jpg', 'jpeg', 'gif', 'png' requis)!";
             }  
          
        }else {
          // "La taille de l'imge ne doit pas depasser 2 Mo";
         $erreur = "La taille de l'imge ne doit pas depasser 2 Mo";
        }
    }else{
      //"Veuillez selectionner une image !"
       $erreur = "Veuillez selectionner une image !";
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

    </div>
  </div>
</body>

</html>