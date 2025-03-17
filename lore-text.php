<?php
    session_start();
    require_once 'Commun/bdd.php';

    $requete = $db->executeSQL("SELECT id, categorie,titre, text FROM lore WHERE id = ?", [$_GET['ID']]);

    if(!isset($requete[0])){
        header('Location: index');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Commun/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
    <style>
        .body{
            margin: 0;
            padding: 5% 30%;
            box-sizing: border-box;
            font-size: 1.4em;
            text-align: justify;
            color: var(--white);
            font-family: var(--mainFont);
        }

        .titre-1{
            font-size: 1.8em;
        }

        .titre-2{
            font-size: 1.4em;
        }

        .titre-3{
            font-size: 1.4em;
            color: rgba(255, 255, 255, 0.7);
        }

        .image-lore{
            display: flex;
            width: 60%;
            margin: auto;
        }

        .editer{
            position: fixed;
            left: 0;
            bottom: 20%;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 1.9%;
            border: solid var(--thirdColor) 1px;
            border-radius: 0.5em;

            font-size: 2em;

            transition: all 300ms ease-in-out;
            background-color: transparent;
            color: var(--white);

            font-family: var(--mainFont);
        }

        .editer:hover{
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--thirdColor);
        }
    </style>
    <title><?php echo $requete[0]['titre'];?></title>
</head>
<body class="body">
    <?php
        echo $requete[0]['text'];
    ?>

    <?php
        if(!isset($_SESSION['connexion']) || $_SESSION['droit'] != 1){
            echo "</body>
            </html>";
            exit();
        }
    ?>

</body>
<form action="add_lore" method="POST">
    <button type="submit" class="editer">
        <span class='material-symbols-outlined' style='font-size: 1.5em;'>
            edit_square
        </span>
        <span>Éditer</span>
        <input type="hidden" name="id" value="<?php echo $requete[0]['id'];?>">
    </button>
</form>
</html>