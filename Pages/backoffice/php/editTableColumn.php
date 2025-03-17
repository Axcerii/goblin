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
        $value = $data['value'] ?? null;
    
        if (!$table || !$id || $value === null) {
            echo json_encode(["error" => "Paramètres manquants ou incorrects"]);
            exit;
        }

        // Mettre à jour la valeur dans la base de données

        $db->executeSQL("ALTER TABLE $table RENAME COLUMN $id TO $value", []);
    }
?>