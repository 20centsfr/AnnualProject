<?php //test

include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_POST['Supprimer'])) {
    $idSalle = ($_POST['Supprimer']);
    $q = "DELETE FROM salle WHERE idSalle='$idSalle' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_salles.php?message=Salle supprimée.');
        exit;
    } else {
        header('location:admin_salles.php?message=Erreur.');
    }
}

if (isset($_POST['Modifier'])) {

    if(!isset($_POST['numSalle']) || empty($_POST['numSalle']) ||
        !isset($_POST['nbPlaceSalle']) || empty($_POST['nbPlaceSalle']) ||
        !isset($_POST['dispoSalle']) || empty($_POST['dispoSalle'])) {
        header('location:admin_salles.php?message=Veuillez remplir tous les champs.');
        exit;
    }


    $nbPlaceSalle = htmlspecialchars($_POST['nbPlaceSalle']);
    $numSalle = htmlspecialchars($_POST['numSalle']);
    $dispoSalle = htmlspecialchars($_POST['dispoSalle']);
    $idSalle = ($_POST['Modifier']);


    $q = "UPDATE salle SET numSalle=:numSalle, nbPlaceSalle =:nbPlaceSalle,dispoSalle=:dispoSalle WHERE idSalle='$idSalle' ";
    $req = $db->prepare($q);
    $req->execute([
        'numSalle' => $numSalle,
        'nbPlaceSalle' => $nbPlaceSalle,
        'dispoSalle' => $dispoSalle
    ]);

    if ($req) {
        header('location: admin_salles.php?message=Activité modifiée');
        exit;
    } else {
        header('location:admin_salles.php?message=Erreur.');
    }
}