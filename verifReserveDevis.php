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

    //todo
    $idSalleParActivite = array();
    $idHoraireParActivite = array();
    $dateChoisiParActivite = array();
    foreach ($idActivites as $idActivite) {
        $idSalleParActivite[$idActivite] = $_POST['salles'][$idActivite][0];
        $idHoraireParActivite[$idActivite] = $_POST['horaires'][$idActivite][0];
        $dateChoisiParActivite[$idActivite] = $_POST['dateChoisi'][$idActivite];
    }


    /*foreach ($idActivites as $idActivite) {
        $q = "INSERT INTO activiteReserve (idReserve, idActivite) VALUES (:idReserve, :idActivite)";
        $req = $db->prepare($q);
        $result = $req->execute([
            'idReserve' => $idReserve,
            'idActivite' => $idActivite
        ]);
    }
    */

    if ($result) {

        echo "<form id='hidden-form' method='POST' action='participants.php' style='display:none;'>";
        echo "<input type='hidden' name='idReserve' value='" . $idReserve . "'>";
        echo "</form>";

        echo "<script>document.getElementById('hidden-form').submit();</script>";
         exit;
     } else {
         header('location: reserverDevis.php?message=Erreur.&type=error');
         exit;
     }
 } else {
     header('location: reserverDevis.php?message=Veuillez cocher toutes les cases.&type=error');
 }

?>