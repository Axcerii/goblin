<?php
    if(isset($_SESSION['connexion']) == false){
        header('Location: connexion');
        exit();
    }
    else if($_SESSION['droit'] != 1){
        header('Location: index');
        exit();
    }
?>