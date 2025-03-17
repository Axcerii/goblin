<?php

    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    $nom = $_POST['nom'];
    $clan = $_POST['clan'];
    $description = $_POST['description'];
    $visibility = $_POST['visibility'];
    $orientation = $_POST['orientation'];

    $stats = $_POST['Statistiques'];
    $maitrise = $_POST['Maîtrises'];
    $comp = $_POST['Compétences'];
    $metier = $_POST['Métiers'];

    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !== '') {
        $image = $_FILES['image']['name'];
        $target_dir = "../../../../personnages/images/";
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
        $image = 'Censor.jpg';
    }



    try{
        $db->executeSQL("INSERT INTO personnages (orientation, visibility, nom, clan, description, image) VALUES (?, ?, ?, ?, ?, ?)", [$orientation, $visibility,$nom, $clan, $description, $image]);
        $sql = "INSERT INTO stats VALUES (DEFAULT, '$nom',";
        foreach($stats as $value){
            if($value == ''){
                $value = 0;
            }
            $sql .= " $value,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ", DEFAULT, DEFAULT)";
        $db->executeSQL($sql);

        $sql = "INSERT INTO compétences VALUES (DEFAULT, '$nom',";
        foreach($comp as $value){
            if($value == ''){
                $value = 0;
            }
            $sql .= " $value,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ", DEFAULT, DEFAULT)";
        $db->executeSQL($sql);

        $sql = "INSERT INTO metier VALUES (DEFAULT, '$nom',";
        foreach($metier as $value){
            if($value == ''){
                $value = 0;
            }
            $sql .= " $value,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ", DEFAULT, DEFAULT)";
        $db->executeSQL($sql);

        $sql = "INSERT INTO maitrise VALUES (DEFAULT, '$nom',";
        foreach($maitrise as $value){
            if($value == ''){
                $value = 0;
            }
            $sql .= " $value,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ", DEFAULT, DEFAULT)";
        $db->executeSQL($sql);

        header("Location: ../../../../../backoffice.php");
        exit;
    }
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }


?>