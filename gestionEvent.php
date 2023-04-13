<?php // todo + idLieu

include 'includes/db.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if (isset($_POST['Supprimer'])) {
    $id = ($_POST['Supprimer']);
    $q = "DELETE FROM event WHERE idEvent='$id' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location:admin_event.php?message=Event supprimé');
        exit;
    } else {
        header('location:admin_event.php?message=Erreur.');
    }
}

if (isset($_POST['Modifier'])) {
    if(!isset($_POST['nomEvent']) || empty($_POST['nomEvent']) || !isset($_POST['dateEvent']) || empty($_POST['dateEvent']) || !isset($_POST['heureEvent']) || empty($_POST['heureEvent']) || !isset($_POST['nbPlacesEvent']) || empty($_POST['nbPlacesEvent']) || !isset($_POST['lieuEvent']) || empty($_POST['lieuEvent']) || !isset($_POST['pointEvent']) || empty($_POST['pointEvent']) || !isset($_POST['descriptionEvent']) || empty($_POST['descriptionEvent']) ) {
        header('location:admin_event.php?message=Veuillez remplir tous les champs.');
        exit;
    }

    $nomEvent = htmlspecialchars($_POST['nomEvent']);
    $heureEvent = $_POST['heureEvent'];
    $dateEvent = $_POST['dateEvent'];
    $nbPlacesEvent=htmlspecialchars($_POST['nbPlacesEvent']);
    $pointEvent=htmlspecialchars($_POST['pointEvent']);
    $lieuEvent=htmlspecialchars($_POST['lieuEvent']);
    $descriptionEvent=htmlspecialchars($_POST['descriptionEvent']);
    $idm = ($_POST['Modifier']);


    $q = "UPDATE event SET nomEvent=:nomEvent, heureEvent=:heureEvent, dateEvent=:dateEvent,nbPlacesEvent=:nbPlacesEvent, pointEvent=:pointEvent, lieuEvent=:lieuEvent, descriptionEvent=:descriptionEvent WHERE idEvent='$idm' ";
    $req = $db->prepare($q);
    $req->execute([
        'nomEvent' => $nomEvent,
        'heureEvent' => $heureEvent,
        'dateEvent' => $dateEvent,
        'nbPlacesEvent'=>  $nbPlacesEvent,
        'pointEvent' => $pointEvent,
        'lieuEvent'=> $lieuEvent,
        'descriptionEvent'=> $descriptionEvent
    ]);

    if ($req) {
        header('location:admin_event.php?message=Event modifié');
        exit;
    } else {
        header('location:admin_event.php?message=Erreur.');
    }
}