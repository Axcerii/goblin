<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pages/backoffice/backoffice.css">
    <title>Back-Office</title>
</head>
<header>
    <?php
        require_once 'Commun/header/header.php';
        require_once 'Commun/redirect/redirectAdmin.php';
        require_once 'Commun/bdd.php';
    ?>
</header>

<!-- 
CLASS :
    div-tableContainer = Conteneur des tableaux de données
    div-table = Tableau de données
-->

<body>
    <h1> Tableau de Bord </h1>
    <div class="div-tableContainer">
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////    OBJETS    ////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-objets'>
            <h2> Objets </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Références d'Objets
                <button class='add-button' onclick="afficherModal('objets')"> + </button>
                <input class='input-search' type="text" name="search" id="search-objets" placeholder="Rechercher" oninput="searching('table-#objets', 'search-objets')">
            </legend>
            <?php
                $objets = $db->executeSQL('SELECT id, catégorie, rareté, nom, poids, description, image FROM objets ORDER BY nom');
                printTable($objets, 'objets');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Objets 
                <button class='add-button' onclick="afficherModal('inventaires')"> + </button>
                <input class='input-search' type="text" name="search" id="search-inventaires" placeholder="Rechercher" oninput="searching('table-#inventaires', 'search-inventaires')">
            </legend>
            <?php
                $inventaires = $db->executeSQL('SELECT id, nom, appartenance, quantity, noyau FROM inventaires ORDER BY nom');
                printTable($inventaires, 'inventaires');
            ?>
        </fieldset>
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////    ARGENTS    ////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-argents'>
            <h2> Argents </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Argent 
                <button class='add-button' onclick="afficherModal('argents')"> + </button>
                <input class='input-search' type="text" name="search" id="search-argents" placeholder="Rechercher" oninput="searching('table-#argents', 'search-argents')">
            </legend>
            <?php
                $argents = $db->executeSQL('SELECT id, appartenance, montant, modifiedAt FROM argents ORDER BY appartenance');
                printTable($argents, 'argents');
            ?>
        </fieldset>
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend style="padding-right:0.5em;"> Distribution </legend>
            <form class="form-distribution" action="Pages/backoffice/php/distribution.php" method="POST">
                <?php
                    $joueurs = $db->executeSQL('SELECT argents.id, joueurs.nom, montant FROM joueurs JOIN argents ON joueurs.nom = argents.appartenance JOIN personnages ON joueurs.nom = personnages.nom ORDER BY clan, nom');
                    foreach($joueurs as $key => $value){
                        echo "<div class='div-distribution'>";
                        echo "<p> $value[nom] </p>";
                        echo "<p> $value[montant] <span style='font-weight: bold; color: yellow;'>PO</span> </p>";
                        echo "<input type='hidden' name='id[]' value='$value[id]'>";
                        echo "<input type='number' name='montant[]'>";
                        echo "</div>";
                    }
                ?>
                <button>Valider</button>
            </form>
        </fieldset>
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////    Caractéristiques    ///////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-carac'>
            <h2> Caractéristiques </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend style="padding-right:0.5em;"> Groupe de Statistiques
                <input class='input-search' type="text" name="search" id="search-stats_by_carac" placeholder="Rechercher" oninput="searching('table-#stats_by_carac', 'search-stats_by_carac')">
            </legend>
            <?php
                $stats_by_carac = $db->executeSQL('SELECT id, stats, carac FROM stats_by_carac ORDER BY stats, carac');
                printTable($stats_by_carac, 'stats_by_carac');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Compétences 
                <button class='add-button' onclick="afficherModal('competences')"> + </button>
                <input class='input-search' type="text" name="search" id="search-compétences" placeholder="Rechercher" oninput="searching('table-#compétences-column', 'search-compétences')">
            </legend>
            <?php
                $competences = $db->executeSQL('SELECT * FROM compétences LIMIT 1');
                printTableColumn($competences, 'compétences');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend>  Métiers
                <button class='add-button' onclick="afficherModal('metiers')"> + </button>
                <input class='input-search' type="text" name="search" id="search-metier" placeholder="Rechercher" oninput="searching('table-#metier-column', 'search-metier')">
            </legend>
            <?php
                $metiers = $db->executeSQL('SELECT * FROM metier LIMIT 1');
                printTableColumn($metiers, 'metier');
                ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Maîtrises
                <button class='add-button' onclick="afficherModal('maitrises')"> + </button>
                <input class='input-search' type="text" name="search" id="search-maitrise" placeholder="Rechercher" oninput="searching('table-#maitrise-column', 'search-maitrise')">
            </legend>
            <?php
                $maitrise = $db->executeSQL('SELECT * FROM maitrise LIMIT 1');
                printTableColumn($maitrise, 'maitrise');
            ?>
        </fieldset>
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////    FEATS    //////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-feats'>
            <h2> Feats </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Feats Référence
                <button class='add-button' onclick="afficherModal('feats')"> + </button>
                <input class='input-search' type="text" name="search" id="search-feats" placeholder="Rechercher" oninput="searching('table-#feats', 'search-feats')">
            </legend>
            <?php
                $feats = $db->executeSQL('SELECT id, nom, carac, pallier, description FROM feats ORDER BY carac, pallier');
                printTable($feats, 'feats');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Feats par Joueurs
                <button class='add-button' onclick="afficherModal('feats_for_players')"> + </button>
                <input class='input-search' type="text" name="search" id="search-feats_for_players" placeholder="Rechercher" oninput="searching('table-#feats_for_players', 'search-feats_for_players')">
            </legend>
            <?php
                $feats_for_players = $db->executeSQL('SELECT id, players_id, feats_id FROM feats_for_players ORDER BY players_id, feats_id');
                printTable($feats_for_players, 'feats_for_players');
            ?>
        </fieldset>
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////    Personnages    ////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-personnages'>
            <h2> Personnages </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Joueurs 
                <button class='add-button' onclick="afficherModal('joueurs')"> + </button>
                <input class='input-search' type="text" name="search" id="search-joueurs" placeholder="Rechercher" oninput="searching('table-#joueurs', 'search-joueurs')">
            </legend>
            <?php
                $joueurs = $db->executeSQL('SELECT id, nom, identifiant, mdp, droit FROM joueurs ORDER BY nom');
                printTable($joueurs, 'joueurs');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend style="padding-right:0.5em;"> Ajouter une image </legend>
            <form action="Pages/backoffice/php/add/image.php" method="POST" enctype="multipart/form-data">
                <h2> Personnages/Monstres : </h2>
                <input type="hidden" name="url" value="../../../personnages/images/">
                <input type="file" name="image" class='input-file'>
                <button class='classic-button'>Valider</button>
            </form>
            <form action="Pages/backoffice/php/add/image.php" method="POST" enctype="multipart/form-data">
                <h2> Références d'Objets : </h2>
                <input type="hidden" name="url" value="../../../stock/images/">
                <input type="file" name="image" class='input-file'>
                <button class='classic-button'>Valider</button>
            </form>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar" style='width: 93%;'>
            <legend> Personnages
                    <button class='add-button' onclick="afficherModal('personnages')"> + </button>
                    <input class='input-search' type="text" name="search" id="search-personnages" placeholder="Rechercher" oninput="searching('table-#personnages', 'search-personnages')">
             </legend>
            
            <?php
                $personnages = $db->executeSQL('SELECT id, visibility, nom, clan, orientation, image, description FROM personnages ORDER BY nom');
                printTable($personnages, 'personnages', 'deleteStats.php');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar" style='width: 93%;'>
            <legend> Monstres
                    <button class='add-button' onclick="afficherModal('monstres')"> + </button>
                    <input class='input-search' type="text" name="search" id="search-monstres" placeholder="Rechercher" oninput="searching('table-#monstres', 'search-monstres')">
             </legend>
            
            <?php
                $monstres = $db->executeSQL('SELECT id, visibility, visibility_effect, nom, orientation, image, description, effet FROM monstres ORDER BY nom');
                printTable($monstres, 'monstres', 'deleteStats.php');
            ?>
        </fieldset>
        <!-- 
        //////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////    Sorts    //////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////// 
        -->
        <div class="separation" id='ancre-sorts'>
            <h2> Sorts & Techniques </h2>
            <div class="separateur"></div>
        </div>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Sorts 
                <button class='add-button' onclick="afficherModal('sort_par_joueur')"> + </button>
                <input class='input-search' type="text" name="search" id="search-sorts_par_joueurs" placeholder="Rechercher" oninput="searching('table-#sorts_par_joueurs', 'search-sorts_par_joueurs')">
            </legend>
            <?php
                $sorts_par_joueurs = $db->executeSQL('SELECT id, joueur, sort FROM sorts_par_joueurs ORDER BY joueur');
                printTable($sorts_par_joueurs, 'sorts_par_joueurs');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar">
            <legend> Techniques
                <button class='add-button' onclick="afficherModal('techniques_par_joueurs')"> + </button>
                <input class='input-search' type="text" name="search" id="search-techniques_par_joueurs" placeholder="Rechercher" oninput="searching('table-#techniques_par_joueurs', 'search-techniques_par_joueurs')">
            </legend>
            <?php
                $techniques_par_joueurs = $db->executeSQL('SELECT id, joueur, technique FROM techniques_par_joueurs ORDER BY joueur');
                printTable($techniques_par_joueurs, 'techniques_par_joueurs');
            ?>
        </fieldset>
        <!-- SEPARATION -->
        <fieldset class="fieldset-table invisible-scrollbar" style='width: 93%;'>
            <legend> Références des Sorts
                    <button class='add-button' onclick="afficherModal('sorts')"> + </button>
                    <input class='input-search' type="text" name="search" id="search-sorts" placeholder="Rechercher" oninput="searching('table-#sorts', 'search-sorts')">
             </legend>
            
            <?php
                $sorts = $db->executeSQL('SELECT id, nom, core, inventeur, cout, cooldown, cast, degats, typeDegats, conditions, effet, description FROM sorts ORDER BY nom');
                printTable($sorts, 'sorts', 'delete.php');
            ?>
        </fieldset>
        <!-- SEPARATION -->
            <fieldset class="fieldset-table invisible-scrollbar" style='width: 93%;'>
            <legend> Références des techniques
                    <button class='add-button' onclick="afficherModal('techniques')"> + </button>
                <input class='input-search' type="text" name="search" id="search-techniques" placeholder="Rechercher" oninput="searching('table-#techniques', 'search-techniques')">
             </legend>
            
            <?php
                $techniques = $db->executeSQL('SELECT id, nom, inventeur, carac, cout, cooldown, degats, typeDegats, conditions, effet, description FROM techniques ORDER BY nom');
                printTable($techniques, 'techniques', 'delete.php');
            ?>
        </fieldset>
        <!-- Débug Table -->
         <div class='div-debug-container'>
             <button onclick="afficherDebug()" class='button-afficher-debug'> Afficher debug section </button>
             <section class='section-debug' id='section-debug'>
                <!-- SEPARATION -->
                <fieldset class="fieldset-table invisible-scrollbar fieldset-table-debug">
                    <legend style="padding-right:0.5em;"> Statistiques
                    </legend>
                    
                    <?php
                        $stats = $db->executeSQL('SELECT * FROM stats ORDER BY nom');
                        printTable($stats, 'stats');
                    ?>
                </fieldset>
                <!-- SEPARATION -->
                <fieldset class="fieldset-table invisible-scrollbar fieldset-table-debug">
                    <legend style="padding-right:0.5em;"> Maîtrises
                    </legend>
                    
                    <?php
                        $maitrise = $db->executeSQL('SELECT * FROM maitrise ORDER BY nom');
                        printTable($maitrise, 'maitrise');
                    ?>
                </fieldset>
                <!-- SEPARATION -->
                <fieldset class="fieldset-table invisible-scrollbar fieldset-table-debug">
                    <legend style="padding-right:0.5em;"> Compétences
                    </legend>
                    
                    <?php
                        $comp = $db->executeSQL('SELECT * FROM compétences ORDER BY nom');
                        printTable($comp, 'compétences');
                    ?>
                </fieldset>
                <!-- SEPARATION -->
                <fieldset class="fieldset-table invisible-scrollbar fieldset-table-debug">
                    <legend style="padding-right:0.5em;"> Métiers
                    </legend>
                    
                    <?php
                        $metier = $db->executeSQL('SELECT * FROM metier ORDER BY nom');
                        printTable($metier, 'metier');
                    ?>
                </fieldset>
                <!-- SEPARATION -->
                <fieldset class="fieldset-table invisible-scrollbar fieldset-table-debug">
                    <legend style="padding-right:0.5em;"> Lore
                    </legend>
                    
                    <?php
                        $lore = $db->executeSQL('SELECT id, titre, categorie FROM lore ORDER BY titre');
                        printTable($lore, 'lore');
                    ?>
                </fieldset>
             </section>
        </div>
    </div>
    
    <div class='links'>
        <a href="#ancre-objets"><span class='material-symbols-outlined'>deployed_code</span></a>
        <a href="#ancre-argents"><span class='material-symbols-outlined'>$</span></a>
        <a href="#ancre-carac"><span class='material-symbols-outlined'>sort</span></a>
        <a href="#ancre-feats"><span class='material-symbols-outlined'>sweep</span></a>
        <a href="#ancre-personnages"><span class='material-symbols-outlined'>group</span></a>
        <a href="#ancre-sorts"><span class='material-symbols-outlined'>stack_star</span></a>
    </div>


    <section id="modal-formulaire">
        <button class='modal-close' onclick = 'fermerModal()'> × </button>
        <div id="modal-content" class="invisible-scrollbar">

        </div>
    </section>
    <section id="modal-background">

    </section>

    <script
  src="https://code.jquery.com/jquery-3.7.1.slim.js"
  integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
  crossorigin="anonymous"></script>
    <script src="Pages/backoffice/editTable.js"></script>
    <script src="Pages/backoffice/backoffice.js"></script>
</body>
</html>

<?php
    //###########################################FUNCTIONS#########################################
    /* printTable(array)
        Affiche toutes les données d'un tableau avec des colonnes préfaites
            <table class='table-data' id='...'>
                <tr>
                    <th>id</th>
                    <th>...</th>
                </tr>
                <tr>
                    <td class='td-id'> id </td>
                    <td>...</td>
                    <td>
                        <form action = '...' method='POST'>
                            <input type='hidden' name='id' value='id'>
                            <input type='submit' class='delete-button'> × </button>
                        </form>
                    </td>
                </tr>
            </table>
    */

    function printTable($table, $tableName = null, $stats = "delete.php"){
        if($table == null){
            return;
        }

        echo "<table class='table-data' id='table-#$tableName'>
        <tr>";
        foreach($table[0] as $key => $value){
            if($key == 'id'){
                echo "<th class='td-id'>";
                echo $key;
                echo "</th>";
            }
            else{
                echo "<th>";
                echo $key;
                echo "</th>";
            }
        }
        echo "<th> Suppr </th>";
        echo "</tr>";
        foreach($table as $key => $value){
            echo "<tr>";

            foreach($value as $key2 => $value2){
                if($key2 == 'id'){
                    echo "<td class='td-id'>";
                    echo $value2;
                    echo "</td>";
                }
                else{
                    echo "<td>";
                    if($value2 != null){
                        echo nl2br($value2); //$value2;
                    }
                    else{
                        echo $value2;
                    }
                    echo "</td>";
                }
            }

            echo "
                <td>
                    <form action='Pages/backoffice/php/$stats' method='POST'>";
                
                if(isset($value['nom'])){
                    echo "
                    <input type='hidden' name='nom' value='$value[nom]'>
                    ";
                }

                echo "
                        <input type='hidden' name='table' value='$tableName'>
                        <input type='hidden' name='id' value='$value[id]'>
                        <button class='delete-button' type='submit'>×</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        echo "</table>";
    }

    function printTableColumn($table, $tableName = null, $stats = "deleteColumn.php"){
        if($table == null){
            return;
        }

        echo "<table class='table-data' id='table-#$tableName-column'>
        <th>Colonne</th>
        <th>Suppr</th>";
        foreach($table[0] as $key => $value){
            if($key != 'id' && $key != 'modifiedAt' && $key != 'createdAt' && $key != 'nom'){
                
            echo "<tr>
            <td class='td-id'>$key</td>
            <td>
            $key
            </td>
            ";


            echo "
                <td>
                    <form action='Pages/backoffice/php/$stats' method='POST'>";
                
                if(isset($value['nom'])){
                    echo "
                    <input type='hidden' name='nom' value='$value[nom]'>
                    ";
                }

                echo "
                        <input type='hidden' name='table' value='$tableName'>
                        <input type='hidden' name='nom' value='$key'>
                        <input type='hidden' name='id' value='0'>
                        <button class='delete-button' type='submit'>×</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    }
?>