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
        header('location: admin_users.php?message=Compte supprimé');
        exit;
    } else {
        header('location:admin_users.php?message=Erreur.');
    }
}

if (isset($_POST['Bannir'])) {
    $idUser = ($_POST['Bannir']);
    $q = "UPDATE user SET banned = 1 WHERE idUser = :idUser";
    $req = $db->prepare($q);
    $req->execute([ 'idUser'=>$idUser ]);
    
    if ($req) {
        header('location: admin_users.php?message=User banni.');
        exit;
    } else {
        header('location:admin_users.php?message=Erreur.');
    }
}


?>