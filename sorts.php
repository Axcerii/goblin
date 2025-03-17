<?php
    require_once "Commun/bdd.php";
    require_once "Commun/classes/sorts.php";
    require_once "Commun/classes/techniques.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/sorts/sorts.css">
    <title>Sorts</title>
</head>
<body>
    <header>
        <?php
            require_once 'Commun/header/header.php';
            $sortRequete = $db->executeSQL("SELECT id, nom, core, inventeur, cout, cooldown, cast, degats, typeDegats, conditions, effet, description FROM sorts ORDER BY core ASC,nom ASC");
            $techniqueRequete = $db->executeSQL("SELECT id, nom, carac, inventeur, cout, cooldown, degats, typeDegats, conditions, effet, description FROM techniques ORDER BY carac ASC,nom ASC");

            $sorts =[];
            foreach($sortRequete as $value){
                $sorts[] = new Sorts($value, $db);
            }

            $techniques =[];
            foreach($techniqueRequete as $value){
                $techniques[] = new Techniques($value, $db);
            }
        ?>
    </header>

    <h2>Sorts</h2>
    <div class='sorts-container'>
        <?php
            foreach($sorts as $key => $value){
                $value->displaySort();
            }
        ?>
    </div>

    <h2>Techniques</h2>
    <div class='sorts-container'>
        <?php
            foreach($techniques as $key => $value){
                $value->displayTechnique();
            }
        ?>
    </div>
    
</body>
</html>