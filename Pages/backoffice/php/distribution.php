<?php
    session_start();
    require_once "../../../Commun/bdd.php";
    require_once "../../../Commun/redirect/redirectAdmin.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $montant = $_POST['montant'];
        $id = $_POST['id'];

        foreach($id as $key => $value){
            if($montant[$key] != null){
                $db->executeSQL("UPDATE argents SET montant = montant + ?  WHERE id = ?", [$_POST['montant'][$key], $value]);
            }
        }

        header("Location: ../../../backoffice.php");
    }
?>