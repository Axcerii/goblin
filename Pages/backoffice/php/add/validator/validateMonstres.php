<?php

    session_start();
    require_once '../../../../../Commun/redirect/redirectAdmin.php';
    require_once '../../../../../Commun/bdd.php';

    $nom = $_POST['nom'];
    $effet = $_POST['effet'];
    $description = $_POST['description'];
    $visibility = $_POST['visibility'];
    $visibility_effect = $_POST['visibility_effect'];
    $race = $_POST['race'];
    $orientation = $_POST['orientation'];

    $stats = $_POST['Statistiques'];
    $maitrise = $_POST['Maîtrises'];
    $comp = $_POST['Compétences'];

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


    if(!($db->executeSQL('SELECT nom FROM stats WHERE nom = ?', [$nom]))){
        try{
        $db->executeSQL("INSERT INTO monstres (orientation, visibility, nom, effet, description, image, race, visibility_effect) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$orientation, $visibility,$nom, $effet, $description, $image, $race, $visibility_effect]);
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
}
else{
    try{
        $db->executeSQL("INSERT INTO monstres (orientation, visibility, nom, effet, description, image, race) VALUES (?, ?, ?, ?, ?, ?, ?)", [$orientation,$visibility,$nom, $effet, $description, $image, $race]);
    }
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        exit();
    }
    echo "Le monstre possède déjà des statistiques. Si cela est voulu alors <a href='../../../../../backoffice.php'>cliquez ici</a>, sinon supprimez manuellement les statistiques via l'outil de debug et supprimer le monstre déjà créé.";
}


?>