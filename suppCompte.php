<?php
session_start();
require('includes/db.php');
if (isset($_POST['Supprimer'])) {
    $idUser = $_POST['Supprimer'];

    $q = "DELETE FROM activiteReserve WHERE idReserve IN (SELECT idReserve FROM reservation WHERE idUser = :idUser)";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    $q = "DELETE FROM participants WHERE idReserve IN (SELECT idReserve FROM reservation WHERE idUser = :idUser)";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    $q = "DELETE FROM horaireReserve WHERE idReserve IN (SELECT idReserve FROM reservation WHERE idUser = :idUser)";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    $q = "DELETE FROM reservation WHERE idUser = :idUser";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    $q = "DELETE FROM devis WHERE idUser = :idUser";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    $q = "UPDATE user SET email = 'DELETED', mdp = '' WHERE idUser = :idUser";
    $req = $db->prepare($q);
    $req->execute(['idUser' => $idUser]);

    if ($req) {
        header('location: index.php?message=Compte supprimé');
        session_destroy();
        exit;
    } else {
        header('location:profile.php?message=Erreur lors de la suppression du compte.');
    }
}

?>