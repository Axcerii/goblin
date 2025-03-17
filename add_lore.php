<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Commun/style.css">
    <link rel="stylesheet" href="Pages/lore/add_lore.css">
    <title><?php if(isset($_POST['id'])) echo "Modifier"; else echo "Ajouter";?> du Lore</title>
</head>
<body>
    <?php
        require_once 'Commun/header/header.php';
        require_once 'Commun/redirect/redirectAdmin.php';
        require_once 'Commun/bdd.php';
    ?>
    <form action="Pages/lore/php/textValidator.php" method="POST" class="form-globale">
        <?php
            include 'Pages/lore/php/text_editor.php';
        ?>
        <input type="submit" value="Valider" class='classic-button'>
        <?php
            if(isset($_POST['id'])){
                echo "<input type='hidden' name='id' value='".$_POST['id']."'>";
                echo "<input type='hidden' name='action' value='update'>";
            }
        ?>
    </form>


    <?php
        if(isset($_POST['id'])){
            echo "
                <form action='Pages/lore/php/delete.php' method='POST'>
                    <input type='hidden' name='id' value='$_POST[id]'>
                    <input type='submit' value='Supprimer' class='classic-button'>
                </form>
            ";
        }
    ?>


    <div class='add-image'>
        <p>Ajouter une Image</p>
        <input type="file" name="image" class='input-file' id="image-file">
        <input type="submit" value="Valider" class='classic-button' id="add-image-button">
        <div class='image-names-container'>
            <p id="image-names"></p>
        </div>
    </div>
    
    <p id="imageMessages"></p>

    <script src="Pages/lore/lore.js"></script>

    <?php
        if(isset($_POST['id'])){
            $requete = $db->executeSQL("SELECT id, categorie,titre, text FROM lore WHERE id = ?", [$_POST['id']]);

            echo "<script>
                const content = `".revertCustomTags($requete[0]['text'])."`;
                const title = `".$requete[0]['titre']."`;
                const categorie = `".$requete[0]['categorie']."`;

                document.getElementById('editor-textarea').value = content;
                document.getElementById('title').value = title;
                document.getElementById('categorie2').value = categorie;
                document.getElementById('categorie1').value = categorie;
            </script>";
        }
    ?>
</body>
</html> 

<?php

function revertCustomTags($input) {
    // Revertir les balises HTML en balises personnalisées
    $patterns = [
        '/<strong>(.*?)<\/strong>/s',              // Gras : <strong>...</strong> -> §b...§
        '/<h3 class=\"titre-3\">(.*?)<\/h3>/s',  // Titre 3 : <h3>...</h3> -> §t3...§
        '/<h2 class=\"titre-2\">(.*?)<\/h2>/s',  // Titre 2 : <h2>...</h2> -> §t2...§
        '/<h1 class=\"titre-1\">(.*?)<\/h1>/s',  // Titre 1 : <h1>...</h1> -> §t1...§
        '/<img src=\"Pages\/lore\/images\/(.*?)\" alt=\".*?\" class=\"image-lore\">/s', // Image -> §image ... §
    ];
    $replacements = [
        '§b$1§',          // Remplacement pour gras
        '§t3$1§',         // Remplacement pour titre3
        '§t2$1§',         // Remplacement pour titre2
        '§t1$1§',         // Remplacement pour titre1
        '§image $1 §',    // Remplacement pour image
    ];

    // Appliquer les remplacements pour revenir aux balises personnalisées
    $reverted = preg_replace($patterns, $replacements, $input);

    // Remplace les <br><br> par un double saut de ligne (pour marquer les espaces visuels)
    $reverted = preg_replace('/(<br\s*\/?>\s*){2,}/i', "\n\n", $reverted);
    // Remplace les <br> restants par un simple saut de ligne
    $reverted = preg_replace('/<br\s*\/?>/i', "\n", $reverted);

    return $reverted;
}

?>