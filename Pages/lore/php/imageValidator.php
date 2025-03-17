<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Chemin pour sauvegarder les images
$uploadDir = __DIR__ . '/../images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Réponse par défaut
$response = ['success' => false, 'message' => 'Erreur inconnue.'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];
    $allowedFormats = ['image/webp', 'image/gif', 'image/jpeg', 'image/png'];
    $maxSize = 5 * 1024 * 1024; // 5 Mo

    // Validation du type de fichier
    $fileMimeType = mime_content_type($file['tmp_name']);
    if (!in_array($fileMimeType, $allowedFormats)) {
        $response['message'] = "Format de fichier non autorisé.";
        echo json_encode($response);
        exit;
    }

    // Validation de la taille du fichier
    if ($file['size'] > $maxSize) {
        $response['message'] = "La taille de l'image dépasse la limite de 5 Mo.";
        echo json_encode($response);
        exit;
    }

    // Génération d'un nom unique pour le fichier
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $uniqueFileName = $file['name'];

    // Déplacement du fichier
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $uniqueFileName)) {
        $response['success'] = true;
        $response['message'] = "Image téléchargée avec succès.";
    } else {
        $response['message'] = "Erreur lors du téléchargement du fichier.";
    }
} else {
    $response['message'] = "Aucun fichier envoyé ou une erreur s'est produite.";
}

echo json_encode($response);