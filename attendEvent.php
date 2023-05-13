<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');

if (isset($_POST["attend"])) {
    $idEvent = $_POST["idEvent"];
    $idUser = $_SESSION["idUser"];

    var_dump($idEvent);

    $q = "INSERT INTO participEvent (idEvent, idUser, participe) VALUES (:idEvent, :idUser, :participe) ON DUPLICATE KEY UPDATE participe=1";
    $req = $db->prepare($q);
    $req->execute([
        'idEvent' => $idEvent,
        'idUser' => $idUser,
        'participe' => 1
    ]);

    $q = "SELECT nbPointsEvent FROM event WHERE idEvent = :idEvent";
    $req = $db->prepare($q);
    $req->execute(['idEvent' => $idEvent]);
    $pts = $req->fetch();

    if ($pts) {
        $q = "UPDATE user SET nbPoints = nbPoints + :nbPoints WHERE idUser = :idUser";
        $req = $db->prepare($q);
        $req->execute([
            'nbPoints' => $pts['nbPointsEvent'],
            'idUser' => $_SESSION['idUser']
        ]);
    }

    if ($req) {
        header('location: profile.php?message=Succès');
        exit;
    } else {
        header('location:reservations.php?message=Erreur.');
    }

}


?>
