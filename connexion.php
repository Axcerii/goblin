<?php
include_once "Commun/bdd.php";
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/connexion/connexion.css">
    <link rel="shortcut icon" href="Favicon/favicon.ico" type="image/x-icon">
    <title>Connexion</title>

</head>
<header>
    <?php
    include_once "Commun/header/header.php";
    if(isset($_SESSION['connexion'])){
        header('Location: profil');
      }
    ?>
</header>


<?php
  if(isset($_SESSION['connexion'])){
    header('Location: profil');
  }
?>
<body>
    <form action="connexion.php" method="POST">
        <div class='label_input'>
            <label for="username">Nom d'utilisateur :</label>
            <input type="username" name="username" class="inputText" id="username" placeholder="Lin Gober">
        </div>
        <div class="label_input">
        <label for="password">Mot de passe :</label>
        <input type="password" name ="password"class="inputText" id="password" placeholder="mon_super_motdepasse">
      </div>
      <button type="submit">Se Connecter</button>
    </form> 
</body>
</html>

<?php

if(isset($_POST['username']) && isset($_POST["password"])){
    $infoConnexion = $db -> executeSQL("SELECT * from joueurs WHERE identifiant = ?", [$_POST['username']]);

    if(isset($infoConnexion[0])){
        $infoConnexion = $infoConnexion[0];
    }

    if(isset($infoConnexion['mdp'])){
        if($infoConnexion['mdp'] == $_POST["password"]){

            $_SESSION['connexion'] = true;
            $_SESSION['droit'] = $infoConnexion['droit'];
            $_SESSION['nom'] = $infoConnexion['nom'];
            $_SESSION['id'] = $infoConnexion['id'];
            header('Location: profil');
        }
        else{
            echo "<p class='identifiant-error'>Identifiants Incorrect</p>";
        }
    }
    else{
        echo "<p class='identifiant-error'>Informations Incorrect</p>";
    }
}

?>