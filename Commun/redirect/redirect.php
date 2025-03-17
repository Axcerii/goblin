<?php
    if(isset($_SESSION['connexion'])){
        $_SESSION['connexion'] = true;
    }
    else{
        header('Location: connexion');
        exit();
    }
?>