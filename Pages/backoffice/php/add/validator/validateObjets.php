<?php
    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){   

        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $rarete = $_POST['rarete'];
        $poids = $_POST['poids'];
        $categorie = $_POST['categorie'];
        $image = $_POST['image'];

        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !== '') {
            $image = $_FILES['image']['name'];
            $target_dir = "../../../../stock/images/";
            $target_file = $target_dir . basename($image);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
            } else {
                echo "Le fichier n'est pas une image.";
                $uploadOk = 0;
            }
    
            // Check file size
            if ($_FILES["image"]["size"] > 5000000) {
                echo "Le fichier ne doit pas faire plus de 5MB.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif', 'webp'])) {
                echo "Seul les formats d'images classiques sont acceptés. (jpg, jpeg, png, gif, webp)";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars(basename($image)). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $image = NULL;
        }

        try {
            
            $db->executeSQL("INSERT INTO objets (nom, description, rareté, poids, catégorie, image) VALUES (?, ?, ?, ?, ?, ?)", [$nom, $description, $rarete, $poids, $categorie, $image]);
            header("Location: ../../../../../backoffice.php");
            exit;
        
        } catch (Exception $e) {
            echo "Une erreur s'est produite : " . $e->getMessage();
        }
    }
?>