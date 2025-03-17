<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/personnages/personnages.css">
    <title>Personnages</title>
</head>
<header>
    <?php
        include_once 'Commun/header/header.php';
    ?>
</header>
<body>
<?php
include "Commun/bdd.php";
?>
    <div class="background-pattern"></div>
    <div class="background-pattern-radial"></div>

    <?php

        if(isset($_SESSION['connexion']) && $_SESSION['droit'] == 1){
            $personnages = $db->executeSQL("SELECT personnages.nom, orientation, personnages.image FROM personnages LEFT JOIN joueurs ON personnages.nom = joueurs.nom WHERE joueurs.nom IS NULL ORDER BY personnages.nom;", []);
            $monstres = $db->executeSQL("SELECT nom, image, orientation FROM monstres  ORDER BY nom", []);
            $joueurs = $db->executeSQL("SELECT personnages.nom, image, orientation FROM joueurs JOIN personnages ON joueurs.nom = personnages.nom ORDER BY nom", []);
        }
        else{
            $personnages = $db->executeSQL("SELECT personnages.nom, personnages.image, orientation FROM personnages LEFT JOIN joueurs ON personnages.nom = joueurs.nom WHERE joueurs.nom IS NULL AND personnages.visibility = 1 ORDER BY personnages.nom;", []);
            $monstres = $db->executeSQL("SELECT nom, image, orientation FROM monstres WHERE visibility = 1 ORDER BY nom", []);
            $joueurs = $db->executeSQL("SELECT personnages.nom, image, orientation FROM joueurs JOIN personnages ON joueurs.nom = personnages.nom WHERE personnages.visibility = 1 ORDER BY nom", []);
        }
    ?>

    <div class='partie-superieur'>
        <div class="info-option">
            <h1> Personnages </h1>
            <input type="text" id='search_bar' onkeyup="myFunction()" placeholder="Axra, Adam, Promo...">
        </div>
        
        <div class='info-option'>
            <div class='categorie'>
                <label for="personnages" class='label-categorie'>
                    <input type="radio" name='categorie' id='personnages'  class='radio-bouton' onchange='switchCategorie()' checked>
                    <img src="Pages/personnages/images/boutons/Personnages.svg" alt="Personnages" class='radio-personnages-img'>
                </label>
                <label for="player" class='label-categorie'>
                    <input type="radio" name='categorie' id='player' class='radio-bouton' onchange='switchCategorie()'>
                    <img src="Pages/personnages/images/boutons/Players.svg" alt="Player" class='radio-personnages-img'>
                </label>
                <label for="bestiaire" class='label-categorie'>
                    <input type="radio" name='categorie' id='bestiaire' class='radio-bouton' onchange='switchCategorie()'>
                    <img src="Pages/personnages/images/boutons/Monstres.svg" alt="Bestiaire" class='bestiaire-img'>
                </label>
            </div>
        </div>
    </div>

    <div class='mainZone'>
        <div class='cards'>
            <div class="mainZoneCard" id='MainZoneCard'>
                <?php
                    creerCartesPersonnages($personnages);
                ?>
            </div>
        
            <div class="mainZoneCard" id="BestiaireZoneCard">
                <?php
                    creerCartesBestiaire($monstres);
                ?>
            </div>

            <div class="mainZoneCard" id="PlayerZoneCard">
                <?php
                    creerCartesPersonnages($joueurs);
                ?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="Pages/personnages/personnages.js"></script>
</body>
</html>

<?php

function creerCartesPersonnages($personnages){
    foreach($personnages as $value){

        if(file_exists("Pages/personnages/images/".$value['image']) == false){
            $value['image'] = "censor.jpg";
        }

        $orientation = mb_strtolower($value['orientation']);

        echo "<script> console.log(\"$orientation\") </script>";

        if($orientation != 'allié' && $orientation != 'ennemi'){
            $orientation = 'autre';
        }

        echo "
        <div class='card ".$value['nom']."'>
            <form action = 'fichePersonnage.php' method='GET'>
                <button type='submit'>
                    <div class='img-card-container'>
                        <div class='clip-path'>
                            <img src='Pages/personnages/images/".$value['image']."' class='img-card'>
                        </div>
                    </div>
                    <img src='Pages/personnages/images/Cadre.png' class='cadre-card svg-black'>
                    <img src='Commun/images/Gobelin.svg' class='ethnie svg-$orientation'>
                    <div class='blackscreen'></div> 
                    <p class='Name'>".$value['nom']." 
                        <span style='display: none;'></span>
                    </p> 
                </button>
                <input type='hidden' name='ID' value='".$value['nom']."'></input>
            </form>
            <p class='mobile-name'>".$value['nom']."</p>
        </div>";
    }
}

function creerCartesBestiaire($all){
    foreach($all as $value){

        if(file_exists("Pages/personnages/images/".$value['image']) == false){
            $value['image'] = "censor.jpg";
        }

        $orientation = mb_strtolower($value['orientation']);

        echo "<script> console.log(\"$orientation\") </script>";

        if($orientation != 'allié' && $orientation != 'ennemi'){
            $orientation = 'autre';
        }

        echo "
        <div class='card ".$value['nom']."'>
            <form action = 'bestiaire.php' method='GET'>
                <button type='submit'>
                    <div class='img-card-container'>
                        <div class='clip-path'>
                            <img src='Pages/personnages/images/".$value['image']."' class='img-card'>
                        </div> 
                    </div>
                    <img src='Pages/personnages/images/Cadre.png' class='cadre-card svg-black'> 
                    <img src='Commun/images/Gobelin.svg' class='ethnie svg-$orientation'>
                    <div class='blackscreen'></div>
                    <p class='Name'>".$value['nom']." <span style='display: none;'></span></p>
                </button>
            <input type='hidden' name='ID' value='".$value['nom']."'></input>
            </form>
            <p class='mobile-name'>".$value['nom']."</p>
        </div>";
    }
}

?>
</body>
</html>