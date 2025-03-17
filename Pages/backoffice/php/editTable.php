<?php
    session_start();

    require_once "../../../Commun/bdd.php";
    require_once "../../../Commun/redirect/redirectAdmin.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lire et décoder les données JSON
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Vérifier que les données sont bien présentes
        $table = $data['table'] ?? null;
        $id = $data['id'] ?? null;
        $column = $data['column'] ?? null;
        $value = $data['value'] ?? null;
    
        if (!$table || !$id || !$column || $value === null) {
            echo json_encode(["error" => "Paramètres manquants ou incorrects"]);
            exit;
        }

        $oldValue = $db->executeSQL("SELECT $column FROM $table WHERE id = ?", [$id])[0][$column];

        // Mettre à jour la valeur dans la base de données

        $db->executeSQL("UPDATE $table SET $column = ? WHERE id = ?", [$value, $id]);
        
        if($table == "objets" && $column == "nom"){
            $db->executeSQL("UPDATE inventaires SET nom = ? WHERE nom = ?", [$value, $oldValue]);
        }

        else if($table == 'personnages' && $column == 'nom'){
            $db->executeSQL("UPDATE joueurs SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE stats SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE maitrise SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE compétences SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE metier SET nom = ? WHERE nom = ?", [$value, $oldValue]);
        }

        else if($table == 'monstres' && $column == 'nom'){
            $db->executeSQL("UPDATE stats SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE maitrise SET nom = ? WHERE nom = ?", [$value, $oldValue]);
            $db->executeSQL("UPDATE compétences SET nom = ? WHERE nom = ?", [$value, $oldValue]);
        }

        else if($table == 'sorts' && $column == 'nom'){
            $db->executeSQL("UPDATE sorts_par_joueurs SET nom = ? WHERE nom = ?", [$value, $oldValue]);
        }

        else if($table == 'techniques' && $column == 'nom'){
            $db->executeSQL("UPDATE techniques_par_joueurs SET technique = ? WHERE technique = ?", [$value, $oldValue]);
        }

        else if($table == 'feats' && $column == 'nom'){
            $db->executeSQL("UPDATE feats_for_players SET feat = ? WHERE feat = ?", [$value, $oldValue]);
        }
    }
?>