<?php
session_start();
require('includes/db.php');
include ('includes/gestionDroits.php');

if (isset($_POST['Supprimer'])) {
    $idLogs = ($_POST['Supprimer']);
    $q = "DELETE FROM logs WHERE idLogs='$idLogs' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_connexion.php?message=Log supprimé');
        exit;
    } else {
        header('location:admin_connexion.php?message=Erreur.');
    }
}

?>