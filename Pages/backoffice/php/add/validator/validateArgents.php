<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $montant = $_POST['montant'];
        $appartenance = $_POST['appartenance'];

        try {
            
            $db->executeSQL("INSERT INTO argents (montant, appartenance) VALUES (?, ?)", [$montant, $appartenance]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>