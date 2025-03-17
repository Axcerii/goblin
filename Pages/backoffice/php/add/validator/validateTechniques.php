<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $inventeur = $_POST['inventeur'];
        $cout = $_POST['cout'];
        $cooldown = $_POST['cooldown'];
        $degats = $_POST['degats'];
        $typeDegats = $_POST['typeDegats'];
        $conditions = $_POST['conditions'];
        $effet = $_POST['effet'];
        $carac = $_POST['carac'];

        try {
            
            $db->executeSQL("INSERT INTO techniques (nom, inventeur, cout, cooldown, degats, typeDegats, conditions, effet, description, carac) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$nom, $inventeur, $cout, $cooldown, $degats, $typeDegats, $conditions, $effet, $description, $carac]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>