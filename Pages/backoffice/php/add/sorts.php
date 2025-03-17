<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';
?>

<h2>Création d'un sort</h2>

<form action="Pages/backoffice/php/add/validator/validateSorts.php" method="POST" class="form-add" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom du sort <span class="span-indication">Unique</span></label>
        <input type="text" name="nom" required>
    </div>
    <div class="form-group">
        <label for="core"> Noyau </label>
        <input type="text" name="core" required placeholder="Feu, Eau, Terre...">
    </div>
    <div class="form-group">
        <label for="inventeur"> Inventeur </label>
        <input type="text" name="inventeur">
    </div>
    <div class="form-group">
        <label for="cout">Coût <span class="span-indication">Rien par défaut</span></label>
        <input type="text" name="cout">
    </div>
    <div class="form-group">
        <label for="cooldown">Temps de rechargement <span class="span-indication">0 par défaut</span></label>
        <input type="Number" name="cooldown">
    </div>
    <div class="form-group">
        <label for="cast">Temps de concentration <span class="span-indication">0 par défaut</span></label>
        <input type="Number" name="cast">
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