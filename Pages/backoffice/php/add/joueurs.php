<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $personnages = $db->executeSQL('SELECT nom FROM personnages ORDER BY nom');
?>
<h2>Création d'un profil joueur</h2>
<div class='add-alert'>Attention, le personnage associé doit être créé avant la création du joueur</div>
<form action="Pages/backoffice/php/add/validator/validateJoueurs.php" method="POST" class="form-add">
    <div class="form-group">
        <label for="nom">Nom du personnages <span class='span-indication'>Références</span></label>
        <div class="div-reference">
            <input type="text" name="nom" id="input-form-nom-JOUEURS">
            <select id="select-form-nom-JOUEURS">
                <?php
                    foreach($personnages as $value){
                        echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="identifiant">Identifiant de connexion <span class="span-indication">Unique</span></label>
        <input type="text" name="identifiant" id="form-identifiant" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe <span class="span-indication">Non-encrypté, ne pas mettre un vrai mot de passe !</span></label>
        <input type="password" name="password" id="form-password" required>
    </div>
    <div class="form-group">
        <label for="droit">Niveau d'Administration</label>
        <select name="droit" id="form-droit">
            <option value="0">Utilisateur Normal</option>
            <option value="1">Administrateur</option>
        </select>
    </div>
    <button type="submit" class="form-button-add">Ajouter</button>
</form>