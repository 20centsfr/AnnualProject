<?php //todo

include 'includes/db.php';
include ('includes/gestionDroits.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_POST['Supprimer'])) {
    $idActivite = ($_POST['idActivite']);
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

    if(!isset($_POST['nom']) || empty($_POST['nom']) ||
        !isset($_POST['places']) || empty($_POST['places']) ||
        !isset($_POST['description']) || empty($_POST['description']) ||
        !isset($_POST['prix']) || empty($_POST['prix']) ||
        !isset($_POST['local']) || empty($_POST['local']) ||
        !isset($_POST['duree']) || empty($_POST['duree'])) {
        header('location:admin_activites.php?message=Veuillez remplir tous les champs.');
        exit;
    }
    
    $nomActivite = htmlspecialchars($_POST['nom']);
    $nbPlacesActivite = htmlspecialchars($_POST['places']);
    $descriptionActivite = htmlspecialchars($_POST['description']);
    $tarifActivite = htmlspecialchars($_POST['prix']);
    $localActivite = htmlspecialchars($_POST['local']);
    $dureeActivite = htmlspecialchars($_POST['duree']);
    $idActivite = htmlspecialchars($_POST['Modifier']);


    $q = "UPDATE activite SET nomActivite=:nomActivite, nbPlacesActivite =:nbPlacesActivite, descriptionActivite=:descriptionActivite, tarifActivite=:tarifActivite, localActivite=:localActivite, dureeActivite=:dureeActivite  WHERE idActivite='$idActivite' ";
    $req = $db->prepare($q);
    $req->execute([
        'nomActivite' => $nomActivite,
        'nbPlacesActivite' => $nbPlacesActivite,
        'descriptionActivite' => $descriptionActivite,
        'tarifActivite' => $tarifActivite,
        'localActivite' => $localActivite,
        'dureeActivite' => $dureeActivite
    ]);



    if ($req) {
        header('location: admin_activites.php?message=Activité modifiée&type=success');
        exit;
    } else {
        header('location:admin_activites.php?message=Erreur.&type=danger');
    }
}