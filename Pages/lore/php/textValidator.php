<?php

require_once '../../../Commun/bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['content'];
    $title = $_POST['title'];
    if($_POST['categorie2'] == null){
        $categorie = $_POST['categorie1'];
    }
    else{
        $categorie = $_POST['categorie2'];
    }
    $text = convertCustomTags($text);

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $db->executeSQL('UPDATE lore SET titre = ?, text = ?, categorie = ? WHERE id = ?', [$title, $text, $categorie, $_POST['id']]);
    }
    else{
        $db->executeSQL('INSERT INTO lore (titre, text, categorie) VALUES (?, ?, ?)', [$title, $text, $categorie]);
    }
    header("Location: ../../../lore.php");
}

function convertCustomTags($input) {
    // Conversion des balises personnalisées
    $patterns = [
        '/§b(.*?)§/s',      // Gras : §gras...gras§ -> <strong>...</strong>
        '/§t3(.*?)§/s',  // Titre 3 : §titre3...titre3§ -> <h3>...</h3>
        '/§t2(.*?)§/s',  // Titre 3 : §titre3...titre3§ -> <h3>...</h3>
        '/§t1(.*?)§/s',  // Titre 2 : §titre2...titre2§ -> <h2>...</h2>
        '/§image (.*?) §/s',         // Image : §image...§ -> <img src="...">
    ];
    $replacements = [
        '<strong>$1</strong>',   // Remplacement pour gras
        '<h3 class="titre-3">$1</h3>',          // Remplacement pour titre3
        '<h2 class="titre-2">$1</h2>',          // Remplacement pour titre3
        '<h1 class="titre-1">$1</h1>',          // Remplacement pour titre2
        '<img src="Pages/lore/images/$1" alt="$1" class="image-lore">', // Remplacement pour image
    ];

    // Appliquer les remplacements
    $converted = preg_replace($patterns, $replacements, $input);

    // Conversion des retours à la ligne en <br>
    $converted = nl2br($converted);

    return $converted;
}

?>