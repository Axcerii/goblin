<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Commun/style.css">
    <link rel="stylesheet" href="Pages/lore/lore.css">
    <title>Lore</title>
</head>
<body>
    <?php
        require_once 'Commun/header/header.php';
        require_once 'Commun/bdd.php';

        $categories = $db->executeSQL("SELECT DISTINCT categorie FROM lore");

        echo "<ul class='colonne' id='choix'>";
        foreach($categories as $categorie){
            echo "<li class='categorie' id='cat_".$categorie['categorie']."' onmouseover='afficherTitres(\"".$categorie['categorie']."\")'>".$categorie['categorie']."</li>";
        }
        echo "</ul>";

        foreach($categories as $categorie){
            afficherTitres($categorie['categorie'], $db);
        }
    ?>

<div id='preview'>
</div>

<?php
    if(isset($_SESSION) && isset($_SESSION['connexion']) && $_SESSION['droit'] == 1){
        echo "
            <a href='add_lore' class='ajouter'>
                <span class='material-symbols-outlined' style='font-size: 2em;'>
                    edit_square
                </span>
                <span> Ajouter </span>
            </a>
        ";
    }
?>

<script>
    function afficherTitres(categorie) {
        var titres = document.getElementsByClassName('titres');
        for (var i = 0; i < titres.length; i++) {
            if (titres[i].id != categorie) {
                titres[i].style.display = 'none';
            } else {
                titres[i].style.display = 'flex';
            }
        }
    }

    function loadHTML(url, selector) {
    const element = document.querySelector(selector);
    if (!element) {
        console.error(`Aucun élément trouvé pour le sélecteur : ${selector}`);
        return;
    }

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            element.innerHTML = html;
        })
        .catch(error => {
            console.error('Erreur lors du chargement du contenu HTML :', error);
        });
}
</script>

</body>
</html>
<?php

    function afficherTitres($categorie, $db){
        $titres = $db->executeSQL("SELECT id, titre, text FROM lore WHERE categorie = ?", [$categorie]);

        echo 
        "<ul class='titres colonne' id='$categorie'>";

            foreach($titres as $titre){
                echo "<li class='categorie' onmouseover='loadHTML(\"lore-text.php?ID=".$titre['id']."\", \"#preview\")'><a href='lore-text.php?ID=".$titre['id']."' target='_blank'>".$titre['titre']."</a></li>";
            }

        echo "</ul>";
    }
?>
