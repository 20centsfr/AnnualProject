<?php
session_start();
require('includes/db.php');
include ('includes/gestionDroits.php');

if (isset($_POST['Supprimer'])) {
    $idUser = ($_POST['Supprimer']);
    $q = "DELETE FROM user WHERE idUser='$idUser' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_user.php?message=Compte supprimé');
        exit;
    } else {
        header('location:admin_user.php?message=Erreur lors de la suppression du compte.');
    }
}

?>
