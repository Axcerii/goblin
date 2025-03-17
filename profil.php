<?php
    /* Force -> strength */
    require_once "Commun/bdd.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/profil/profil.css">
    <title>Profil</title>
</head>
<header>
    <?php
        require_once "Commun/header/header.php";
        require_once "Commun/redirect/redirect.php";
        require_once "Commun/classes/personnages.php";

        $nom = $_SESSION['nom'];

        $joueur = new Joueurs($nom, $db);

 /* $personnage = ligne de la table personnage correspondant à l'utilisateur 
        
        ['id'] = INT - id du personnage
        ['nom'] = string - Le nom du personnage et id unique
        ['clan'] = string - Clan du personnage
        ['image'] = string - Nom de l'image du personnage
        ['description] = text - description du personnage
*/
        $personnage = [
            'id' => $joueur->getId(),
            'nom' => $joueur->getNom(),
            'clan' => $joueur->getClan(),
            'image' => $joueur->getImage(),
            'description' => $joueur->getDescription()
        ];

        $requete = $db->executeSQL('SELECT stats, carac FROM stats_by_carac ORDER BY stats, carac');
        $stats_by_carac = [];
        foreach($requete as $key => $value){
            $stats_by_carac[mb_strtolower($value['carac'])] = mb_strtolower($value['stats']);
        }

/*  $stats = ligne de la table stats correspondant à l'utilisateur

    ['force']
    ['dextérité']
    ['endurance']
    ['sagesse']
    ['charisme']
    ['dévotion']

*/

        $stats = $joueur->getStatistiques();

        /* En cas de changement de nom, déconnecter le joueur s'il essaie d'accéder à son profil */


            if(empty($stats)){
                header('Location: Commun/deconnexion.php'); 
            }

            
/*  $comp = ligne de la table compétences correspondant à l'utilisateur

    ['nage']
    ['survie']
    ['parade']
    ['athlétisme']
    ['résilience']
    ['persuasion']
    ['représentation']
    ['diplomatie']
    ['provocation']
    ['médecine']
    ['ivresse']

*/
        $comp = generateCaracTable($joueur->getComps(), $stats_by_carac);

        

/*  $metier = ligne de la table metier correspondant à l'utilisateur

    ['forge']
    ['minage']
    ['commandant']
    ['herboriste']

*/
        $metier = generateCaracTable($joueur->getMetiers(), $stats_by_carac);

/*  $maitrise = ligne de la table maitrise correspondant à l'utilisateur

    ['id']
    ['nom'] string - nom & id unique
    ['marteau']
    ['bouclier']
    ['épée']
    ['pugilat']
    ['foudre']
    ['feu']
    ['air']

*/
        $maitrise = generateCaracTable($joueur->getMaitrises(), $stats_by_carac);
    ?>
</header>
<body>
    <section class='infos-perso'>
        <p><?php echo $personnage['nom']?></p>
        <img src="Pages/personnages/images/<?php echo $personnage['image'];?>" alt="Image de votre personnage">
    </section>

    <section class='stats-perso'>
            <?php
                displayStats($stats, 'Statistiques');
                displayCarac($comp, 'Compétences', $stats);
                displayCarac($metier, 'Métiers', $stats);
                displayCarac($maitrise, 'Maîtrises', $stats);
            ?>
            <div class='cercle-central'>
                <img src="Pages/profil/images/Gobelin_Centrale.svg" class='blurry-svg-thirdColor' alt="Gobelin">
                <img src="Pages/profil/images/Gobelin_Centrale.svg" class='svg-thirdColor' alt="Gobelin">
            </div>
    </section>
    <section class="objets">
        <h2 class='section-titre'>Objets</h2>
        <div class="objets-container">
            <?php
                $objets = $db -> executeSQL('SELECT catégorie, rareté, objets.nom, poids, description, image, quantity, noyau FROM inventaires JOIN objets ON inventaires.nom = objets.nom WHERE appartenance = ? ORDER BY poids', [$nom]);
                displayObjets($objets);
            ?>
        </div>
        <h2 class='section-titre'> Sorts & Techniques </h2>
        <div class='sorts-container'>
            <?php
                foreach($joueur->getSorts() as $key => $value){
                    $value->displaySort();
                }
                foreach($joueur->getTechniques() as $key => $value){
                    $value->displayTechnique();
                }
            ?>
        </div>
    </section>
    <section>
        <h2 class='section-titre'>Feats</h2>
        <div class='feats-container'>
            <?php
                $playerFeat = $joueur->getFeats();
            ?>
            
            <table class='feats'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Stats</th>
                        <th>Palier</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($playerFeat as $key => $value){
                        echo "<tr>
                            <td> $value[nom] </td>
                            <td> $value[carac] </td>
                            <td> $value[pallier] </td>
                            <td> $value[description] </td>
                        </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>



<?php

///////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Functions////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
    function displayStats($table, $titre){
        echo "
        <div class='stats-container'>
        <img src='Commun/images/$titre.svg' alt='Icone de $titre' class='img-stats-container svg-thirdColor'>
        <p class='stats-title'>$titre</p>";

        foreach($table as $key => $value){
            if($value == 0){
                continue;
            }

            $group = null;
            $label = $key;
            $bonus = floor($value/5);
            $total = $value + $bonus;

            if($bonus > 0){
                $displayBonus = "<span class='stat-bonus'>+$bonus</span>";
                $popup = "<div class='stat-bonus-popup'>$total</div>";
                $hover = "style='cursor: help;'";
            }
            else{
                $displayBonus = "";
                $popup = "";
                $hover = "";
            }
    

            echo "
                <div class='stat-seule'>
                    <p class='stat-label $label'>$label</p>
                    <div class='stat-valeur-container'>
                        <p class='stat-valeur' $hover>$value$displayBonus</p>
                        $popup
                    </div>
                    <div class='stat-barre-container'>
                        <div class='stat-barre' style='width:".($value*3.33)."%;'></div>
                    </div>
                </div>
            ";
        }

        echo "</div>";
        echo "</div>";
    }

        /* Permet d'afficher une section de caractéristique*/
    function displayCarac($table, $titre, $stats){

        echo "
        <div class='stats-container'>
        <img src='Commun/images/$titre.svg' alt='Icone de $titre' class='img-stats-container svg-thirdColor'>
        <p class='stats-title'>$titre</p>";



        foreach($table as $key => $value){
            if($value == 0){
                continue;
            }

            $label = $value['nom'];
            $group = $value['groupe'];
            $valeur = $value['valeur'];
            
            if(isset($stats[$group])){
                $bonus = calculBonusCarac($stats[$group], $valeur);

                if($bonus['bonus'] > 0){
                    $bonusDisplay = "<span class='stat-bonus'>+$bonus[bonus]</span>";
                    $popup = "<div class='stat-bonus-popup'>$bonus[total]</div>";
                    $hover = "style='cursor: help;'";
                }
                else{
                    $bonusDisplay = "";
                    $popup = "";
                    $hover = "";
                }
            }
            else{
                $bonusDisplay = "";
                $popup = "";
                $hover = "";
            }
            

            echo "
                <div class='stat-seule'>
                    <p class='stat-label $group'>$label</p>
                    <div class='stat-valeur-container'>
                        <p class='stat-valeur' $hover>$valeur$bonusDisplay</p>
                        $popup
                    </div>
                    <div class='stat-barre-container'>
                        <div class='stat-barre' style='width:".($valeur*3.33)."%;'></div>
                    </div>
                </div>
            ";
        }

        echo "</div>";
        echo "</div>";
    }

    /* Permet d'echo les objets de l'utilisateur */
    function displayObjets($table){
        foreach($table as $key => $value){

            $quantity = "";
            if($value['quantity'] > 1){
                $quantity = "×".$value['quantity'];
            }

            $noyau = "";
            if($value['noyau'] != 0){
                $noyau = " - Charge : ".$value['noyau'];
            }

            echo "
            <div class='case-objets'>
                <img class='objet-vitre' src='Pages/profil/images/Vitre.png' alt='Vitre'>
                <p class='nom-objets'>".$value['nom'].$noyau."</p>";
                if($value['image'] != null){
                    echo "
                    <div class='image-container'>
                        <img class='image-vitrine' src='Pages/stock/images/".$value['image']."' alt='Vitrine'>
                    </div>";
                }
                else{
                    echo "<img class='image-vitrine rarete-".$value['rareté']."' src='Commun/images/Categories/".$value['catégorie'].".svg' alt='Vitrine'>";
                }
            echo "<div class='objets-popup'>
                    <p class='p-rarete-".$value['rareté']."'>";
                printRarete($value['rareté']);
                echo "</p>
                    <p class='description-objets'>".$value['description']."</p>
                </div>
                <p class='objets-quantity'>$quantity</p>
            </div>";
        }
    }

    /* Permet d'echo la rareté d'un objet par rapport à un chiffre entre 1 et 5 */
    function printRarete($rareté = 1){
        switch($rareté){
            case 1:
                echo "Commun";
                break;
            case 2:
                echo "Rare";
                break;
            case 3:
                echo "Épique";
                break;
            case 4:
                echo "Légendaire";
                break;
            case 5:
                echo "Unique";
                break;
        }
    }

    /* Retourne un tableau contenant :
    - la valeur de la carac ['carac']
    - la valeur du bonus ['bonus']    
    - le total de la carac ['total']
         */
    function calculBonusCarac($statsValue, $caracValue){
        $bonusStats = floor($statsValue/5);
        $bonusCarac = floor($caracValue/5);
        $bonusTotal = $bonusStats + $bonusCarac;

        $final = $caracValue + $bonusTotal;

        return[
            'carac' => $caracValue,
            'bonus' => $bonusTotal,
            'total' => $final
        ];
    }

    /* Génére un tableau associatif pour les caractéristiques */

    function generateCaracTable($carac, $stats_by_carac){
        $table = [];

        foreach($carac as $key => $value){
            if($value == 0){
                continue;
            }

            if(isset($stats_by_carac[$key])){
                $groupe = $stats_by_carac[$key];
            }
            else{
                $groupe = 'no-stats';
            }

            array_push($table, [
                'nom' => $key,
                'valeur' => $value,
                'groupe' => $groupe
            ]);
        }

        return $table;
    }

    /* Permet de trier un tableau selon un ordre */
    function trierTableauSelonOrdre($tableau, $ordre) {
        // Créer un tableau de correspondance pour les priorités
        $priorites = array_flip($ordre);
        
        // Trier le tableau avec usort
        usort($tableau, function($a, $b) use ($priorites) {
            $valA = $a['y'];
            $valB = $b['y'];
            
            // Comparer les priorités
            $priorityA = $priorites[$valA] ?? PHP_INT_MAX; // Par défaut, priorité très basse
            $priorityB = $priorites[$valB] ?? PHP_INT_MAX;
            
            return $priorityA <=> $priorityB;
        });
    
        return $tableau;
    }
?>