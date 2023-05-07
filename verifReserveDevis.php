<?php

include('includes/db.php');
session_start();
include ('includes/connected.php');

$idSalle = $_POST['salles'];
$idHoraire = $_POST['horaires'][0];
$dateChoisi = $_POST['dateChoisi'];
$dateReservation = date('Y-m-d'); 
$idUser = htmlspecialchars($_POST['idUser']);
$idDevis = htmlspecialchars($_POST['idDevis']);

$devisReq = $db->prepare("SELECT * FROM devis WHERE idDevis = ?");
$devisReq->execute([$idDevis]);
$devis = $devisReq->fetch();

$idActivites = array();
$activiteReq = $db->prepare("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis = ?");
$activiteReq->execute([$idDevis]);
while ($activite = $activiteReq->fetch()) {
    $idActivites[] = $activite['idActivite'];
}

var_dump($idActivites);

if (!empty($idHoraire)) {
    $q = "INSERT INTO reservation (idHoraires, nbParticipants, prix, dateReservation, dateChoisi, idUser) VALUES (:idHoraires, :nbParticipants, :prix, :dateReservation, :dateChoisi, :idUser)";
    $req = $db->prepare($q);

    $result = $req->execute([
        'idHoraires' => $idHoraire,
        'nbParticipants' => $devis['nbParticipants'],
        'prix' => $devis['prix'],
        'dateReservation' => $dateReservation, 
        'dateChoisi' => $dateChoisi, 
        'idUser' => $idUser
    ]);

    $idReserve = $db->lastInsertId();

    foreach ($idActivites as $idActivite) {
        $q = "INSERT INTO activiteReserve (idReserve, idActivite) VALUES (:idReserve, :idActivite)";
        $req = $db->prepare($q);
        $result = $req->execute([
            'idReserve' => $idReserve,
            'idActivite' => $idActivite
        ]);
    }
    

    if ($result) {
        header('location: participants.php?message=Succès&type=success');
         exit;
     } else {
         header('location: reserverDevis.php?message=Erreur.&type=error');
         exit;
     }
 } else {
     header('location: reserverDevis.php?message=Veuillez cocher toutes les cases.&type=error');
 }

?>