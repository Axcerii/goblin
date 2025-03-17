<?php
    /* Force -> strength */
    require_once "Commun/bdd.php";
    require_once "Commun/classes/personnages.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/fichePersonnage/fichePersonnage.css">
    <link rel="stylesheet" href="Commun/style.css">
    <title> <?php echo $_GET['ID'];?> </title>
</head>
<body>
    <?php
        require_once "Commun/header/header.php";

        $personnage = new BasePersonnage($_GET['ID'], $db);

        if(isset($_SESSION['connexion'])){
            if($_SESSION['droit'] == 1){
                $personnage = new Personnage($_GET['ID'], $db);
            }
        }
    ?>
    <section class="infos-perso">
        <p id='personnage-nom'><?php echo $personnage->getNom();?></p>
        <div class="informations">
            <img src="Pages/personnages/images/<?php echo $personnage->getImage();?>" alt="Image de <?php echo $personnage->getNom();?>">
            <p class='description'> <?php echo $personnage->getDescription();?> </p>
        </div>
    </section>

    <?php
        if(isset($_SESSION['connexion'])){            
            if($_SESSION['droit'] != 1){
                echo "</body>
                </html>";
                exit();
            }
        }
        else{
            echo "</body>
            </html>";
            exit();
        }
    ?>

    <section class='stats-perso'>
            <?php
                displayStats($personnage->getStatistiques(), 'Statistiques');
                displayStats($personnage->getComps(), 'Compétences');
                displayStats($personnage->getMetiers(), 'Métiers');
                displayStats($personnage->getMaitrises(), 'Maîtrises');
            ?>
            <div class='cercle-central'>
                <img src="Pages/profil/images/Gobelin_Centrale.svg" class='blurry-svg-thirdColor' alt="Gobelin">
                <img src="Pages/profil/images/Gobelin_Centrale.svg" class='svg-thirdColor' alt="Gobelin">
            </div>
    </section>
    <div id='modal-background' onclick='fermerModal(currentModal)'></div>
    <script src="Pages/fichePersonnage/fichePersonnageAdmin.js"></script>
</body>
</html>

<?php

function displayStats($table, $titre){
    /* On prépare notre table */
    unset($table['id']);
    unset($table['nom']);

    echo "<div class='stats-container'>
    <img src='Commun/images/$titre.svg' alt='Icone de $titre' class='img-stats-container svg-thirdColor'>
    <p class='stats-title'>$titre</p>";

    foreach($table as $key => $value){
        $label = $key;

        if($value){
            $display = "flex";
        }
        else{
            $display = "none";
        }

        echo "
            <div class='stat-seule' style='display: $display;' id='id-$titre-$key'>
                <p class='stat-label'>$label</p>
                <input type='number' value='$value' class='stat-input' min='0' max='100' oninput='updateDatabase(\"$label\", \"$titre\")' id='$label'>
            </div>
        ";
    }

    
    
    echo "<button class='classic-button' id='$titre-button' style='width:20%; margin-top: 30px;' onclick='afficherModal(\"$titre\")'>Ajouter</button>";
    echo "</div>";
    echo "
    <div class='modal' id='$titre-modal'>
        <div class='modal-content'>
            <div class='modal-container'>
                <button class='classic-button' onclick='fermerModal(\"$titre\")'>×</button>
                <p class='modal-title'>Ajouter $titre</p>
                <div class='modal-group-container'>";
                

    foreach($table as $key => $value){

        if($value){
            $checked = "checked";
        }
        else{
            $checked = "";
        }

        echo "
            <div class='modal-group'>
                <label for='$titre-$key'>$key</label>
                <input type='checkbox' id='$titre-$key' oninput='afficherInput(\"$titre-$key\")' $checked>
            </div>
        ";
    }
        
    echo "      </div>
            </div>
        </div>
    </div>";
}

?>