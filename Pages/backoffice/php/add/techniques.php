<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';
?>

<h2>Création d'une technique</h2>

<form action="Pages/backoffice/php/add/validator/validateTechniques.php" method="POST" class="form-add" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom de la technique <span class="span-indication">Unique</span></label>
        <input type="text" name="nom" required>
    </div>
    <div class="form-group">
        <label for="inventeur"> Inventeur </label>
        <input type="text" name="inventeur">
    </div>
    <div class="form-group">
        <label for='carac'> Caractéristique </label>
        <select name="carac" id="carac">
            <option value="Force">Force</option>
            <option value="Dextérité">Dextérité</option>
            <option value="Endurance">Endurance</option>
            <option value="Intelligence">Intelligence</option>
            <option value="Sagesse">Sagesse</option>
            <option value="Charisme">Charisme</option>
            <option value="Dévotion">Dévotion</option>
        </select>
    </div>
    <div class="form-group">
        <label for="cout">Coût <span class="span-indication">Rien par défaut</span></label>
        <input type="text" name="cout">
    </div>
    <div class="form-group">
        <label for="cooldown">Cooldown <span class="span-indication">0 par défaut</span></label>
        <input type="Number" name="cooldown">
    </div>
    <div class="form-group">
        <label for="degats">Dégâts <span class="span-indication">0 par défaut</span></label>
        <input type="text" name="degats">
    </div>
    <div class="form-group">
        <label for="typeDegats"> Type de Dégâts </label>
        <input type="text" name="typeDegats" required>
    </div>
    <div class="form-group">
        <label for="conditions"> Conditions </label>
        <input type="text" name="conditions" required>
    </div>
    <div class="form-group">
        <label for="effet"> Effet </label>
        <textarea type="text" name="effet"></textarea>
    </div>
    <div class="form-group">
        <label for="description"> Description </label>
        <textarea type="text" name="description"></textarea>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>