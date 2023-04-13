<?php
include ('includes/db.php');
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
include('includes/db.php'); 

$nomEvent = $_POST['nomEvent'];
$descriptionEvent = $_POST['descriptionEvent'];
$nbPlacesEvent = $_POST['nbPlacesEvent'];
$lieuEvent = $_POST['lieuEvent'];
$dateEvent = $_POST['dateEvent'];
$nbPointsEvent = $_POST['nbPointsEvent'];



$q = "INSERT INTO event (nomEvent, descriptionEvent, nbPlacesEvent, nbPointsEvent, dateEvent, lieuEvent) VALUES (:nomEvent, :descriptionEvent, :nbPlacesEvent, :nbPointsEvent, :dateEvent, :lieuEvent)";
$req = $db->prepare($q);
$req->execute([
    'nomEvent' => $nomEvent,
    'descriptionEvent' => $descriptionEvent,
    'nbPlacesEvent' => $nbPlacesEvent,
    'nbPointsEvent' => $nbPointsEvent,
    'dateEvent' => $dateEvent,
    'lieuEvent' => $lieuEvent
]);

if ($req) {
    header('location: admin_event.php?message=Event ajouté.');
    exit;
} else {
    header('location:admin_event.php?message=Erreur.');
}

?>