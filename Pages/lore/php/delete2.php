<?php
    session_start();
    require_once "../../../Commun/bdd.php";
    require_once "../../../Commun/redirect/redirectAdmin.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
         $db->executeSQL("DELETE FROM lore WHERE id = ?", [$_POST['id']]);
    }
?>