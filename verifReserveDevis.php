<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');

$idSalle = $_POST['salles'];
$idHoraires = $_POST['horaires'][0];
$dateChoisi = $_POST['dateChoisi'];
$dateReservation = date('Y-m-d'); 
$idUser = $_POST['idUser'];
$idActivite = $_POST['$idActivite'];


if (isset($_POST['idDevis'])) {
    $idDevis = $_POST['idDevis'];
} else {
    var_dump([$idDevis]);
}


$qq = "SELECT nbParticipants, prix FROM devis WHERE idDevis = ?";
$stmt = $db->prepare($qq);
if ($stmt->execute([$idDevis])) {
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbParticipants = $res['nbParticipants'];
    $prix = $res['prix'];
}


if (!empty($idSalle) && !empty($idHoraires)) {
    $q = "INSERT INTO reservation (idHoraires, nbParticipants, prix, dateReservation, dateChoisi, idUser, idActivite) VALUES (:idHoraires, :nbParticipants, :prix, :dateReservation, :dateChoisi, :idUser, :idActivite)";
    $req = $db->prepare($q);
    $result = $req->execute([
        'idHoraires' => $idHoraires,
        'nbParticipants' => $nbParticipants,
        'prix' => $prix,
        'dateReservation' => $dateReservation, 
        'dateChoisi' => $dateChoisi, 
        'idUser' => $idUser,
        'idActivite' => $idActivite
    ]);

    if ($result) {
        header('location: participants.php?message=Succès');
        exit;
    } else {
        header('location: reserveDevis.php?message=Erreur.');
        exit;
    }
} else {
    header('location: reserveDevis.php?message=Veuillez cocher les cases nécessaires.');
    exit;
}
?>