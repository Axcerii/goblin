<?php
session_start();
require_once '../../../../Commun/redirect/redirectAdmin.php';

$target_dir = $_POST['url'];
$image = $_FILES['image']['name'];
$target_file = $target_dir . basename($image);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Vérifiez si le fichier a bien été téléchargé
if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    die("Erreur lors du téléchargement : " . $_FILES['image']['error']);
}

// Vérifiez si le fichier est une image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check !== false) {
    echo "Fichier validé : " . $check["mime"] . ".";
} else {
    die("Le fichier n'est pas une image.");
}

// Vérifiez la taille du fichier
if ($_FILES["image"]["size"] > 5000000) {
    die("Le fichier ne doit pas faire plus de 5MB.");
}

// Autorisez certains formats de fichier
if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
    die("Seuls les formats d'images classiques sont acceptés. (jpg, jpeg, png, gif, webp)");
}

// Tentez le déplacement du fichier
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "Fichier uploadé : " . htmlspecialchars(basename($image));
    header("Location: ../../../../../backoffice.php");
    exit;
} else {
    die("Erreur lors du déplacement du fichier.");
}
?>
?>