<?php
    session_start();
    require_once '../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../Commun/bdd.php';

    $competences = $db->executeSQL('SELECT DISTINCT nom FROM competences_for_players ORDER BY nom');
    $personnages = $db->executeSQL('SELECT DISTINCT nom FROM personnages ORDER BY nom');
    $personnages += $db->executeSQL('SELECT DISTINCT nom FROM monstres ORDER BY nom');
?>
<h2>Ajouter des compétences</h2>
<form action="Pages/backoffice/php/add/validator/validateCompétences.php" method="POST" class="form-add">
        <div class="form-group">
            <label for="categorie">Personnages <span class='span-indication'>Références</span></label>
            <div class="div-reference">
                <input type="text" name="appartenance" id="input-form-appartenance" required>
                <select id="select-form-appartenance">
                    <?php
                        foreach($personnages as $value){
                            echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class='comp-group'>
            <div class="form-group">
                <label for="nom">Nom de la Compétence</label>
                <div class='div-reference'>
                    <input type="text" name="nom[]" id="input-form-COMPETENCES-0" required>
                    <select id='select-form-COMPETENCES-0'>
                        <?php
                            foreach($competences as $value){
                                echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur[]" id="input-form-valeur" min="0" max="100" required>
            </div>
        </div>
        <div class='comp-group'>
            <div class="form-group">
                <label for="nom">Nom de la Compétence</label>
                <div class='div-reference'>
                    <input type="text" name="nom[]" id="input-form-COMPETENCES-1">
                    <select id='select-form-COMPETENCES-1'>
                        <?php
                            foreach($competences as $value){
                                echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur[]" id="input-form-valeur" min="0" max="100">
            </div>
        </div>
        <div class='comp-group'>
            <div class="form-group">
                <label for="nom">Nom de la Compétence</label>
                <div class='div-reference'>
                    <input type="text" name="nom[]" id="input-form-COMPETENCES-2">
                    <select id='select-form-COMPETENCES-2'>
                        <?php
                            foreach($competences as $value){
                                echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur[]" id="input-form-valeur" min="0" max="100">
            </div>
        </div>
        <div class='comp-group'>
            <div class="form-group">
                <label for="nom">Nom de la Compétence</label>
                <div class='div-reference'>
                    <input type="text" name="nom[]" id="input-form-COMPETENCES-3">
                    <select id='select-form-COMPETENCES-3'>
                        <?php
                            foreach($competences as $value){
                                echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur[]" id="input-form-valeur" min="0" max="100">
            </div>
        </div>
        <div class='comp-group'>
            <div class="form-group">
                <label for="nom">Nom de la Compétence</label>
                <div class='div-reference'>
                    <input type="text" name="nom[]" id="input-form-COMPETENCES-4">
                    <select id='select-form-COMPETENCES-4'>
                        <?php
                            foreach($competences as $value){
                                echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur[]" id="input-form-valeur" min="0" max="100">
            </div>
        </div>
                            
    <button type="submit" class="form-button-add">Ajouter</button>
</form>