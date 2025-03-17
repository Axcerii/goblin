<?php

session_start();
require_once '../../../../Commun/redirect/redirectAdmin.php';
require_once '../../../../Commun/bdd.php';

?>
<h2>Ajouter un métier</h2>
<form action="Pages/backoffice/php/add/validator/validateMetiers.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="nom">Nom du métier <span class="span-indication">Pas de caractères spéciaux ni d'espace</span></label>
        <input type="text" name="nom" required id="form-nom" pattern="^[a-zA-Z_][a-zA-Z0-9_]*$">
    </div>
    <div class="form-group">
        <label for="description">Statistique associée</label>
        <select name="statistique" id="form-categorie">
            <option value="force">Force</option>
            <option value="dextérité">Dextérité</option>
            <option value="endurance">Endurance</option>
            <option value="intelligence">Intelligence</option>
            <option value="sagesse">Sagesse</option>
            <option value="charisme">Charisme</option>
            <option value="dévotion">Dévotion</option>
        </select>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>