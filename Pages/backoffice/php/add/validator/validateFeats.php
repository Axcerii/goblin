<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['nom'];
        $carac = $_POST['carac'];
        $seuil = $_POST['seuil'];
        $description = $_POST['description'];

        if($seuil == null){
            $seuil = 10;
        }

        try {
            
            $db->executeSQL("INSERT INTO feats (nom, carac, pallier, description) VALUES (?, ?, ?, ?)", [$nom, $carac, $seuil, $description]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>