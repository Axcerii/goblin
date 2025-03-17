<?php

session_start();

if(isset($_SESSION['connexion'])){

    unset($_SESSION['connexion']);
    session_destroy();

}

header('Location: ../connexion.php');

?>