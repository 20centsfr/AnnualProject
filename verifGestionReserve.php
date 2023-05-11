<?php 

include 'includes/db.php';
include ('includes/gestionDroits.php');

if (isset($_POST['Supprimer'])) {
    $idReserve = ($_POST['idReserve']);
    $q = "DELETE FROM reservation WHERE idReserve='$idReserve' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_reservations.php?message=Activité supprimée.');
        exit;
    } else {
        header('location:admin_reservations.php?message=Erreur.');
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
    $idReserve = htmlspecialchars($_POST['Modifier']);


    $q = "UPDATE reservation SET nomActivite=:nomActivite, nbPlacesActivite =:nbPlacesActivite, descriptionActivite=:descriptionActivite, tarifActivite=:tarifActivite, localActivite=:localActivite, dureeActivite=:dureeActivite  WHERE idReserve='$idReserve' ";
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
        header('location: admin_reservation.php?message=Activité modifiée&type=success');
        exit;
    } else {
        header('location:admin_reservation.php?message=Erreur.&type=danger');
    }
}

?>
