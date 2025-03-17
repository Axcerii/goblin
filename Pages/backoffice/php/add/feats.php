<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $maitrise = $db->executeSQL('Describe maitrise');
    $comps = $db->executeSQL('Describe compétences');
    $metier = $db->executeSQL('Describe metier');
    $merge = array_merge($maitrise, $comps, $metier);

    $stats = [];

    foreach($merge as $value){
        if($value['Field'] != "nom" && $value['Field'] != "id" && $value['Field'] != "createdAt" && $value['Field'] != "modifiedAt"){
            array_push($stats, $value['Field']);
        }
    }

    sort($stats);
?>
<h2>Ajouter un sort à un joueur</h2>
<form action="Pages/backoffice/php/add/validator/validateFeats.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="nom">Nom du Feat</label>
        <input type="text" name="nom" required>
    </div>
    <div class="form-group">
        <label for="carac"> Caractéristique <span class='span-indication'>Références</span></label>
        <div class="div-reference">
            <input type="text" name="carac" id="input-form-appartenance" required>
            <select id="select-form-appartenance">
                <?php
                    foreach($stats as $value){
                        echo "<option value='".$value."'>".$value."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="seuil"> Seuil <span class="span-indication">par défaut 10</span></label>
        <input type="Number" name="seuil">
    </div>
    <div class="form-group">
        <label for="description"> Description </label>
        <textarea name="description" id="description"></textarea>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>