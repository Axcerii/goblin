<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['joueur'];
        $appartenance = $_POST['sort'];

        try {
            
            $db->executeSQL("INSERT INTO techniques_par_joueurs (technique, joueur) VALUES (?, ?)", [$appartenance, $nom]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>