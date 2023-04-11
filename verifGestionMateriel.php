<?php //test

include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_POST['Supprimer'])) {
    $idMateriel = ($_POST['Supprimer']);
    $q = "DELETE FROM materiel WHERE idMateriel='$idMateriel' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_materiels.php?message=Materiel supprimé.');
        exit;
    } else {
        header('location:admin_materiels.php?message=Erreur.');
    }
}

if (isset($_POST['Modifier'])) {

    if(!isset($_POST['nomMateriel']) || empty($_POST['nomMateriel']) ||
        !isset($_POST['quantiteMateriel']) || empty($_POST['quantiteMateriel']) ||
        !isset($_POST['typeMateriel']) || empty($_POST['typeMateriel'])) {
        header('location:admin_materiels.php?message=Veuillez remplir tous les champs.');
        exit;
    }


    $quantiteMateriel = htmlspecialchars($_POST['quantiteMateriel']);
    $nomMateriel = htmlspecialchars($_POST['nomMateriel']);
    $typeMateriel = htmlspecialchars($_POST['typeMateriel']);
    $idMateriel = ($_POST['Modifier']);


    $q = "UPDATE materiel SET nomMateriel=:nomMateriel, quantiteMateriel =:quantiteMateriel,typeMateriel=:typeMateriel WHERE idMateriel='$idMateriel' ";
    $req = $db->prepare($q);
    $req->execute([
        'nomMateriel' => $nomMateriel,
        'quantiteMateriel' => $quantiteMateriel,
        'typeMateriel' => $typeMateriel
    ]);

    if ($req) {
        header('location: admin_materiels.php?message=Materiel modifié.');
        exit;
    } else {
        header('location:admin_materiels.php?message=Erreur.');
    }
}