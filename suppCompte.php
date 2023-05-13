<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require('includes/db.php');
var_dump($idUser);
if (isset($_POST['Supprimer'])) {
    $idUser = ($_POST['Supprimer']);
    $q = "DELETE FROM user WHERE idUser='$idUser' ";
    $req = $db->prepare($q);
    $result = $req->execute();
    if ($result) {
        header('location: index.php?message=Compte supprimé');
        exit;
    } else {
        header('location:profile.php?message=Erreur lors de la suppression du compte.');
    }
}

?>