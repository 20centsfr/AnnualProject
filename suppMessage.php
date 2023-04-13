<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require('includes/db.php');

if (isset($_POST['Supprimer'])) {
    $idUser = ($_POST['Supprimer']);
    $q = "DELETE FROM user WHERE idUser='$idUser' ";
    $req = $db->prepare($q);
    $req->execute();
    if ($req) {
        header('location: admin_messages.php?message=Message supprimé');
        exit;
    } else {
        header('location:admin_messages.php?message=Erreur lors de la suppression.');
    }
}

?>