
<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';
?>
<h2> Créer un nouvel objet</h2>
<form action="Pages/backoffice/php/add/validator/validateObjets.php" method="POST" class="form-add" enctype="multipart/form-data">
    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <select name="categorie" id="form-categorie">
            <option value="Arme">Arme</option>
            <option value="Armure">Armure</option>
            <option value="Vivre">Vivre</option>
            <option value="Matériaux">Matériaux</option>
            <option value="Matériaux_Raffinés">Matériaux Raffinés</option>
            <option value="Consommable">Consommable</option>
            <option value="Important">Important</option>
            <option value="Autre">Autre</option>
        </select>
    </div>
    <div class="form-group">
        <label for="rarete">Rareté</label>
        <select name="rarete" id="form-rarete">
            <option value="1">Commun</option>
            <option value="2">Rare</option>
            <option value="3">Épique</option>
            <option value="4">Légendaire</option>
            <option value="5">Unique</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nom">Nom <span class='span-indication'>Unique</span></label>
        <input type="text" name="nom" id="form-nom">
    </div>
    <div class="form-group">
        <label for="poids">Poids</label>
        <input type="number" name="poids" id="form-poids" min="0" max="100" value="0">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="form-description"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="input-file">
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>