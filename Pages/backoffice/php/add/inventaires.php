

<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $appartenance = $db->executeSQL('SELECT nom FROM joueurs ORDER BY nom');
    $objets = $db->executeSQL('SELECT nom FROM objets ORDER BY nom');
?>
<h2>Ajouter un objet à l'inventaire</h2>
<form action="Pages/backoffice/php/add/validator/validateInventaires.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="categorie">Joueurs <span class='span-indication'>Référence, par défaut "Stock"</span></label>
        <div class="div-reference">
            <input type="text" name="appartenance" id="input-form-appartenance">
            <select id="select-form-appartenance">
                <option value="Stock"> Stock </option>
                <?php
                    foreach($appartenance as $value){
                        echo "<option value=\"".$value['nom']."\">".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="nom">Nom de l'Objet <span class="span-indication">Références</span></label>
        <div class='div-reference'>
            <input type="text" name="nom" id="input-form-objets">
            <select id='select-form-objets'>
                <?php
                    foreach($objets as $value){
                        echo "<option value=\"".$value['nom']."\">".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="quantity">Quantité <span class="span-indication">1 par défaut</span></label>
        <input type="Number" name="quantity">
    </div>
    <div class="form-group">
        <label for="noyau"> Noyau <span class="span-indication">0 par défaut</span></label>
        <input type="Number" name="noyau">
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>