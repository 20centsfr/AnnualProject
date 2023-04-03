<?php//test
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$nomEvent = $_POST['nomEvent'];
$descriptionEvent = $_POST['descriptionEvent'];
$nbPlacesEvent = $_POST['nbPlacesEvent'];
$lieuEvent = $_POST['lieuEvent'];
$heureEvent = $_POST['heureEvent'];
$dateEvent = $_POST['dateEvent'];


$q = "INSERT INTO event (nomEvent, descriptionEvent, nbPlacesEvent, nbPointsEvent, dateEvent, heureEvent, lieuEvent) VALUES (:nomEvent, :descriptionEvent, :nbPlacesEvent, :nbPointsEvent, :dateEvent, :heureEvent, :lieuEvent)";
$req = $db->prepare($q);
$req->execute([
    'nomEvent' => $nomEvent,
    'descriptionEvent' => $descriptionEvent,
    'nbPlacesEvent' => $nbPlacesEvent,
    'nbPointsEvent' => $nbPointsEvent,
    'dateEvent' => $dateEvent,
    'heureEvent' => $heureEvent,
    'lieuEvent' => $lieuEvent
]);

if ($req) {
    header('location: admin_event.php?message=Event ajouté.');
    exit;
} else {
    header('location:admin_event.php?message=Erreur.');
}

?>