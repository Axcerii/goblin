<?php
    session_start();
    require_once "../../../Commun/redirect/redirectAdmin.php";
    require_once "../../../Commun/bdd.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $id = $_POST['nom'];
        $table = $_POST['table'];

        try{
            $db->executeSQL('ALTER TABLE '.$table.' DROP COLUMN '.$id);
            header("Location: ../../../backoffice.php");
        }
        catch(Exception $e){
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>