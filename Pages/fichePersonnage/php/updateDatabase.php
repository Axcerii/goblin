<?php
    session_start();

    require_once "../../../Commun/bdd.php";
    //require_once "../../../Commun/redirect/redirectAdmin.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lire et décoder les données JSON
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Vérifier que les données sont bien présentes
        $table = $data['table'] ?? null;
        $id = $data['id'] ?? null;
        $column = $data['column'] ?? null;
        $value = $data['value'] ?? null;

        if(strtolower($column) == "force"){
            $column = "strength";
        }

        $allowedTables = ['stats', 'maitrise', 'compétences', 'metier'];
        if (!in_array($table, $allowedTables)) {
            echo json_encode(["error" => "Table non autorisée"]);
            exit;
        }
    
        if (!$table || !$id || !$column || $value === null) {
            echo json_encode(["error" => "Paramètres manquants ou incorrects"]);
            exit;
        }

        // Mettre à jour la valeur dans la base de données

        try {
            $sql = "UPDATE $table SET $column = $value WHERE nom = '$id'";
            $db->executeSQL($sql);
            echo json_encode(["success" => "Mise à jour réussie"]);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
?>