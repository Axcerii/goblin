<?php
    session_start();
    require_once "../../../Commun/bdd.php";
    require_once "../../../Commun/redirect/redirectAdmin.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $requete = $db->executeSQL("SELECT id, titre FROM lore WHERE id = ?", [$_POST['id']])[0];
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Commun/style.css">
    <title>Confirmation</title>
</head>
<body>
    <h1>Confirmation de suppression</h1>
    <p>Confirmez-vous la suppression de l'article "<?php echo $requete['titre']; ?>" ?</p>
    <form action="delete2.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $requete['id'];?>">
        <input type="submit" value="Confirmer" class="classic-button">
        <a href="../../../lore" class="classic-button">Annuler</a>
    </form>
</body>
</html>

<style>
    body{
        padding: 5% 25%;
        color: var(--white);
    }
</style>