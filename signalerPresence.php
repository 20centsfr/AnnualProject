<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');

if (isset($_POST["attend"])) {
    $idReserve = $_POST["idReserve"];
    $idUser = $_SESSION["idUser"];

    var_dump($idReserve);

    $q = "INSERT INTO participReserve (idReserve, idUser, participe) VALUES (:idReserve, :idUser, :participe) ON DUPLICATE KEY UPDATE participe=1";
    $req = $db->prepare($q);
    $req->execute([
        'idReserve' => $idReserve,
        'idUser' => $idUser,
        'participe' => 1
    ]);

    if ($req) {
        header('location: profile.php?message=Succès');
        exit;
    } else {
        header('location:reservations.php?message=Erreur.');
    }

}

?>
