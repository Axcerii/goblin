<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $core = $_POST['core'];
        $inventeur = $_POST['inventeur'];
        $cout = $_POST['cout'];
        $cooldown = $_POST['cooldown'];
        $cast = $_POST['cast'];
        $degats = $_POST['degats'];
        $typeDegats = $_POST['typeDegats'];
        $conditions = $_POST['conditions'];
        $effet = $_POST['effet'];

        try {
            
            $db->executeSQL("INSERT INTO sorts (nom, core, inventeur, cout, cooldown, cast, degats, typeDegats, conditions, effet, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$nom, $core, $inventeur, $cout, $cooldown, $cast, $degats, $typeDegats, $conditions, $effet, $description]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>