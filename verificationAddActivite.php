<?php
include 'includes/db.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$nomActivite = $_POST['nomActivite'];
$descriptionActivite = $_POST['descriptionActivite'];
$nbPlacesActivite = $_POST['nbPlacesActivite'];
$localActivite = $_POST['localActivite'];
$tarifActivite = $_POST['tarifActivite'];
$dureeActivite = $_POST['dureeActivite'];


$q = "INSERT INTO activite (nomActivite, descriptionActivite, nbPlacesActivite, dureeActivite, tarifActivite, localActivite) VALUES (:nomActivite, :descriptionActivite, :nbPlacesActivite, :dureeActivite, :tarifActivite, :localActivite)";
$req = $db->prepare($q);
$req->execute([
    'nomActivite' => $nomActivite,
    'descriptionActivite' => $descriptionActivite,
    'nbPlacesActivite' => $nbPlacesActivite,
    'dureeActivite' => $dureeActivite,
    'tarifActivite' => $tarifActivite,
    'localActivite' => $localActivite
]);

if ($req) {
    header('location: admin_activites.php?message=Activité ajoutée');
    exit;
} else {
    header('location:admin_activites.php?message=Erreur.');
}

?>