<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $appartenance = $db->executeSQL('SELECT nom FROM joueurs ORDER BY nom');
?>

<h2>Créer une bourse pour un joueur</h2>
<div class='add-alert'>Les bourses sont créées automatiquement, mais vous pouvez en générer en cas de problèmes</div>
<form action="Pages/backoffice/php/add/validator/validateArgents.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="appartenance">Joueurs <span class='span-indication'>Références</span></label>
        <div class="div-reference">
            <input type="text" name="appartenance" id="input-form-appartenance-ARGENTS">
            <select id="select-form-appartenance-ARGENTS">
                <?php
                    foreach($appartenance as $value){
                        echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="montant">Montant</label>
        <input type="number" name="montant" id="input-form-objets" min="0" max="2000000000" value="0">
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>