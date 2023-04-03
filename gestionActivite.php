<?php //todo

include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_POST['Supprimer'])) {
    $idActivite = ($_POST['Supprimer']);
    $q = "DELETE FROM activite WHERE idActivite='$idActivite' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_activites.php?message=Activité supprimée.');
        exit;
    } else {
        header('location:admin_activites.php?message=Erreur.');
    }
}

if (isset($_POST['Modifier'])) {

    if(!isset($_POST['nomActivite']) || empty($_POST['nomActivite']) ||
        !isset($_POST['nbPlacesActivite']) || empty($_POST['nbPlacesActivite']) ||
        !isset($_POST['descriptionActivite']) || empty($_POST['descriptionActivite']) ||
        !isset($_POST['tarifActivite']) || empty($_POST['tarifActivite'])) {
        header('location:admin_activites.php?message=Veuillez remplir tous les champs.');
        exit;
    }


    $nbPlacesActivite = htmlspecialchars($_POST['nbPlacesActivite']);
    $nomActivite = htmlspecialchars($_POST['nomActivite']);
    $descriptionActivite = htmlspecialchars($_POST['descriptionActivite']);
    $tarifActivite = $_POST['tarifActivite'];
    $idActivite = ($_POST['Modifier']);


    $q = "UPDATE activite SET nomActivite=:nomActivite, nbPlacesActivite =:nbPlacesActivite,descriptionActivite=:descriptionActivite, tarifActivite=:tarifActivite, dates=:dates, heures=:heures WHERE idActivite='$idActivite' ";
    $req = $db->prepare($q);
    $req->execute([
        'nomActivite' => $nomActivite,
        'nbPlacesActivite' => $nbPlacesActivite,
        'descriptionActivite' => $descriptionActivite,
        'tarifActivite' => $tarifActivite
    ]);

    if ($req) {
        header('location: admin_activites.php?message=Activité modifiée');
        exit;
    } else {
        header('location:admin_activites.php?message=Erreur.');
    }
}