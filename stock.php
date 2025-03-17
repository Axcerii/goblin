<?php
    require_once "Commun/bdd.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/stock/stock.css">
    <title>Stockage</title>
</head>
<body>
    <h1>Stockage du clan</h1>
    <?php
        require_once "Commun/header/header.php";
        $objets = $db->executeSQL('SELECT objets.id, catégorie, rareté, objets.nom, poids, description, image, quantity, noyau FROM objets JOIN inventaires on objets.nom = inventaires.nom WHERE appartenance = "Stock" ORDER BY catégorie, nom');
        $trier = regrouperParChamp($objets, 'catégorie');

        foreach($trier as $key => $value){
            echo "<h2>".$value[0]['catégorie']."</h2> <div class='objets-container'>";
            foreach($value as $key2 => $value2){
                $quantity = "";
                if($value2['quantity'] > 1){
                    $quantity = "×".$value2['quantity'];
                }

                $noyau = "";
                if($value2['noyau'] != 0){
                    $noyau = " - Charge : ".$value2['noyau'];
                }
                echo "
                <div class='case-objets'>
                    <img class='objet-vitre' src='Pages/profil/images/Vitre.png' alt='Vitre'>
                    <p class='nom-objets'>".$value2['nom'].$noyau."</p>";
                if($value2['image'] != null){
                    echo "
                    <div class='image-container'>
                        <img class='image-vitrine' src='Pages/stock/images/".$value2['image']."' alt='Vitrine'>
                    </div>";
                }
                else{
                    echo "<img class='image-vitrine rarete-".$value2['rareté']."' src='Commun/images/Categories/".$value2['catégorie'].".svg' alt='Vitrine'>";
                }
                echo "
                    <div class='objets-popup'>
                        <p class='p-rarete-".$value2['rareté']."'>";
                    printRarete($value2['rareté']);
                    echo "</p>
                        <p class='description-objets'>".$value2['description']."</p>
                    </div>
                    <p class='objets-quantity'>$quantity</p>
                </div>";
            }
            echo "</div>";
        }
    ?>
    
    

</body>
</html>

<?php

/* Codé par IA */
function regrouperParChamp($tableau, $champ) {
    $resultat = [];

    foreach ($tableau as $element) {
        if (isset($element[$champ])) {
            $valeurChamp = $element[$champ]; 
            $resultat[$valeurChamp][] = $element;
        }
    }

    return array_values($resultat);
}


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



?>