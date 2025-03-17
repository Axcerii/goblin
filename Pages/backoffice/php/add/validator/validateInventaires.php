<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['nom'];
        $appartenance = $_POST['appartenance'];
        $quantity = $_POST['quantity'];
        $noyau = $_POST['noyau'];
        

        if($appartenance == null){
            $appartenance = "Stock";
        }

        try {
            
            $db->executeSQL("INSERT INTO inventaires (nom, appartenance, quantity, noyau) VALUES (?, ?, ?, ?)", [$nom, $appartenance, $quantity, $noyau]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>