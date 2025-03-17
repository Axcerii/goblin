

<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $appartenance = $db->executeSQL('SELECT nom FROM joueurs ORDER BY nom');
    $techniques = $db->executeSQL('SELECT nom FROM techniques ORDER BY nom');
?>
<h2>Ajouter une technique à un joueur</h2>
<form action="Pages/backoffice/php/add/validator/validateTechniqueParJoueur.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="joueur">Joueurs <span class='span-indication'>Références</span></label>
        <div class="div-reference">
            <input type="text" name="joueur" id="input-form-appartenance">
            <select id="select-form-appartenance">
                <?php
                    foreach($appartenance as $value){
                        echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="sort">Nom de la Technique <span class="span-indication">Références</span></label>
        <div class='div-reference'>
            <input type="text" name="sort" id="input-form-objets">
            <select id='select-form-objets'>
                <?php
                    foreach($techniques as $value){
                        echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>