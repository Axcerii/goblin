<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    //$personnages = $db->executeSQL('SELECT nom FROM personnages ORDER BY nom');

    $stats = $db->executeSQL('Describe stats');
    $comp = $db->executeSQL('Describe compétences');
    $metier = $db->executeSQL('Describe metier');
    $maitrise = $db->executeSQL('Describe maitrise');

?>
<h2>Création d'un personnage</h2>

<form action="Pages/backoffice/php/add/validator/validatePersonnages.php" method="POST" class="form-add" enctype="multipart/form-data">
    <div class="form-group">
        <label for="visibility">Visibilité <span class="span-indication">1 = Visible, 0 = Caché</span></label>
        <select name="visibility" id="form-categorie">
            <option value="1">Visible</option>
            <option value="0">Caché pour les utilisateurs</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nom">Nom du personnage <span class="span-indication">Unique</span></label>
        <input type="text" name="nom" required>
    </div>
    <div class="form-group">
        <label for="clan">Clan</label>
        <input type="text" name="clan">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="input-file">
    </div>
    <div class="form-group">
        <label for="orientation">Orientation</label>
        <select name="orientation" id="orientation">
            <option value='Neutre'>Neutre</option>
            <option value='Allié'>Allié</option>
            <option value='Ennemi'>Ennemi</option>
        </select>
    </div>
    <div class="form-group">
        <?php
            printCaracForm($stats, 'Statistiques');
            printCaracForm($maitrise, 'Maîtrises');
            printCaracForm($comp, 'Compétences');
            printCaracForm($metier, 'Métiers');
        ?>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>

<?php

    function printCaracForm($array, $label = 'BUG'){
        echo "<label style='margin-top:0.5em;'> $label <span class='span-indication'>Par défaut à 0</span></label>";
        echo "<div class='div-carac-container'>";
        foreach($array as $value){
            if($value['Field'] == 'strength'){
                $value['Field'] = 'force';
            }

            if($value['Field'] != 'nom' && $value['Field']!= 'id' && $value['Field'] != 'createdAt' && $value['Field'] != 'modifiedAt'){
                echo "
                <div class='div-carac'>
                    <label for='$value[Field]' style='text-transform: capitalize; font-size: 1em;'>$value[Field]</label>
                    <input type='number' name='".$label."[]' min='0' max='100'>
                </div>";
            }
        }
        echo "</div>";
    }
?>