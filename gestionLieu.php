<?php
session_start();
require('includes/db.php');
include ('includes/gestionDroits.php');

if (isset($_POST['Supprimer'])) {
    $idLieu = ($_POST['Supprimer']);
    $q = "DELETE FROM lieu WHERE idLieu='$idLieu' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_lieux.php?message=Log supprimé');
        exit;
    } else {
        header('location:admin_lieux.php?message=Erreur.');
    }
}

?>