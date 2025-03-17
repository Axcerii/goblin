<?php
        session_start();
        require_once '../../../../../Commun/redirect/redirectAdmin.php';
        require_once '../../../../../Commun/bdd.php';
    
        if($_SERVER['REQUEST_METHOD'] === 'POST'){   
            $nom = $_POST['nom'];
            $identifiant = $_POST['identifiant'];
            $password = $_POST['password'];
            $droit = $_POST['droit'];

            try {
                $db->executeSQL("INSERT INTO joueurs (nom, identifiant, mdp, droit) VALUES (?, ?, ?, ?)", [$nom, $identifiant, $password, $droit]);
                $db->executeSQL("INSERT INTO argents (appartenance, montant) VALUES (?, ?)", [$nom, 0]);
                header("Location: ../../../../../backoffice.php");
                exit;
            } catch (Exception $e) {
                echo "Une erreur s'est produite : " . $e->getMessage();
            }
        }
?>