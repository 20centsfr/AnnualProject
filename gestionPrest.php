<?php
session_start();
require('includes/db.php');
include ('includes/gestionDroits.php');

if (isset($_POST['Supprimer'])) {
    $idPrestataire = ($_POST['Supprimer']);
    $q = "DELETE FROM prestataire WHERE idPrestataire='$idPrestataire' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_prest.php?message=Log supprimé');
        exit;
    } else {
        header('location:admin_prest.php?message=Erreur.');
    }
}

?>