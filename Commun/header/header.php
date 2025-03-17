<?php
include_once 'Commun/cookieParam.php';
session_start();
?>


<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
    <link rel="stylesheet" href="Commun/header/header.css">
    <link rel="stylesheet" href="Commun/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="Commun/images/favicon.ico" type="image/x-icon">
    <script src="Commun/header/header.js" defer></script>
</head>
<!--     <div class='burger'>
        <button onclick = "burgerMenu()"><img src="Image/Objets/Burger.svg" alt="Menu"></button>
    </div> -->
    <div class='soft-neige' id='soft-neige'></div>
    <div class='header' id='header'>

        <a href="index" class='link-mobile-logo'>
            <img src="Commun/images/Gobelin.svg" alt="" class='mobile-logo svg-white'>
        </a>

        <a href="index" class='link-logo'>
            <img src="Commun/images/Gobelin.svg" alt="" class='logo svg-white'>
        </a>

        <div class='panneau'>
            <a href="index" class="liens">
                <span class="material-symbols-outlined header-help" data-tooltip='Accueil'>home</span>
                <span class='mobile-link'> Accueil </span> 
            </a>
            <a href="lore" class="liens">
                <span class="material-symbols-outlined header-help" data-tooltip='Histoires'>menu_book</span>
                <span class='mobile-link'> Histoires </span>
            </a>
            <a href="stock" class="liens">
                <span class="material-symbols-outlined header-help" data-tooltip='Stockage'>deployed_code</span>
                <span class='mobile-link'> Stockage </span>
            </a>
            <a href="sorts" class="liens">
                <span class="material-symbols-outlined header-help" data-tooltip='Sorts'>cards_star</span>
                <span class='mobile-link'> Sorts </span>
            </a>
            <a href="personnages" class="liens">
                <span class="material-symbols-outlined header-help" data-tooltip='Personnages'>Groups</span>
                <span class='mobile-link'> Personnages </span>
            </a>
            <a href="connexion" class="liens" id='Profil_2'>
                <span class="material-symbols-outlined header-help" data-tooltip='<?php if(isset($_SESSION['connexion'])){echo 'Profil';} else{echo 'Connexion';}?>'>person</span>
                <span class='mobile-link'> Profil </span>
            </a>
            <?php
                if(isset($_SESSION['connexion'])){
                    if($_SESSION['droit'] == 1){
                        echo "
            <a href='backoffice' class='liens'>
                <span class='material-symbols-outlined header-help' data-tooltip='Back-Office'>precision_manufacturing</span>
                <span class='mobile-link'> Back-Office</span>
            </a>
                        ";
                    }
                    echo "<a href='#' class='liens' id='disconnected'>
                    <span class='material-symbols-outlined header-help' data-tooltip='Déconnexion'>signal_disconnected</span>
                    <span class='mobile-link'> Déconnexion </span>
                    </a>";
                }
            ?>
            <button class="close" onclick = 'closeMenu()'><img src="Image/Objets/Cross.svg" alt=""></button>
        </div>
    </div>