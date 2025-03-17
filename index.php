<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    include_once 'Commun/bdd.php';

    session_start();

    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Ascension des Gobelins</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="Commun/style.css">
    <link rel="stylesheet" href="Pages/index/index.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>

    <div id='menu'>
        <div class='menu-choix'>
            <a href="personnages.php" class="menu-links">Personnages</a>
            <a href="lore" class="menu-links"> Lore </a>
            <?php
            if(isset($_SESSION['connexion'])){
                echo '<a href="connexion.php" class="menu-links"> Profil </a>';
            }
            else{
                echo '<a href="connexion.php" class="menu-links"> Connexion </a>';
            }
            ?>
        </div>
        <div id='background-pattern'>
        <div class="background-pattern-radial"></div>
        </div>
<!--         <div id="background-image">
        </div> -->
        <div id='carre'>
            <img src="Commun/images/Gobelin.svg" alt="image" id='fill-img'>
        </div>        
        <div id='text-descriptif'>
            <p id='paragraph'></p>
        </div>
    </div>
    <script src="Pages/index/index.js"></script>
    <?php
    if(isset($_SESSION['connexion'])){

        $src = $db->executeSQL("SELECT image FROM personnages JOIN joueurs ON personnages.nom = joueurs.nom WHERE joueurs.nom = ?", [$_SESSION['nom']])[0]['image'];

        echo "<script> link[2] = 'Pages/personnages/images/$src';</script>";
    } 

    ?>
</body>
</html>