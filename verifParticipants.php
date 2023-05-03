<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('includes/db.php');
session_start();

$idReservation = $_POST['idReservation'];
$idUser = $_POST['idUser'];
$idDevis = $_POST['idDevis'];

if (isset($_POST['idDevis'])) {
    $idDevis = $_POST['idDevis'];
} else {
    var_dump([$idDevis]);
}


if (!empty($idParticipant)) {
    $q = "INSERT INTO participants (prenom, nom, email) VALUES (:nom, :prenom, :email)";
    $req = $db->prepare($q);
    $result = $req->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ]);

    if ($result) {
        header('location: paiement.php?message=Proceder au paiement');
        exit;
    } else {
        header('location: participants.php?message=Erreur.');
        exit;
    }
} else {
    header('location: participants.php?message=Veuillez remplir tous les champs.');
    exit;
}
?>