<?php
    session_start();
    require_once "../../../Commun/redirect/redirectAdmin.php";
    require_once "../../../Commun/bdd.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $id = $_POST['id'];
        $table = $_POST['table'];
        $nom = $_POST['nom'];

        try{
            $db->delete($table, $id);
            $db->executeSQL('DELETE FROM stats WHERE nom = ?', [$nom]);
            $db->executeSQL('DELETE FROM compétences WHERE nom = ?', [$nom]);
            $db->executeSQL('DELETE FROM maitrise WHERE nom = ?', [$nom]);
            $db->executeSQL('DELETE FROM metier WHERE nom = ?', [$nom]);

            header("Location: ../../../backoffice.php");
        }
        catch(Exception $e){
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>