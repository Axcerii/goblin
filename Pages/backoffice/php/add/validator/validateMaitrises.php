<?php

session_start();
require_once '../../../../../Commun/redirect/redirectAdmin.php';
require_once '../../../../../Commun/bdd.php';

$competences = mb_strtolower($_POST['nom']);
$statistiques = mb_strtolower($_POST['statistique']);

if (empty($competences)) {
    header("Location: ../../../../../backoffice.php");
    exit();
}

try {
    $db->executeSQL("ALTER TABLE maitrise ADD $competences INT(11) NOT NULL DEFAULT '0' AFTER `nom`");
}
catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}
try {
    $db->executeSQL('INSERT INTO stats_by_carac (carac, stats) VALUES (?, ?)', [$competences, $statistiques]);
    header("Location: ../../../../../backoffice.php");
}
catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}
?>