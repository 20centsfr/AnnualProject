<?php
include('includes/db.php');
session_start();
include ('includes/connected.php');

$idActivites = json_decode($_POST['idActivite'], true);
$horairesSelectionnes = array();
foreach($idActivites as $idActivite){
    $horairesSelectionnes[$idActivite['idActivite']] = $_POST['horaires_'.$idActivite['idActivite']];
}

var_dump($horairesSelectionnes);

$dateChoisi = $_POST['dateChoisi'];
$dateReservation = date('Y-m-d'); 
$idUser = htmlspecialchars($_POST['idUser']);
$idDevis = htmlspecialchars($_POST['idDevis']);

$devisReq = $db->prepare("SELECT * FROM devis WHERE idDevis = ?");
$devisReq->execute([$idDevis]);
$devis = $devisReq->fetch();

if (!empty($horairesSelectionnes)) {
    $q = "INSERT INTO reservation (nbParticipants, prix, dateReservation, dateChoisi, idUser) VALUES (:nbParticipants, :prix, :dateReservation, :dateChoisi, :idUser)";
    $req = $db->prepare($q);

    $result = $req->execute([
        'nbParticipants' => $devis['nbParticipants'],
        'prix' => $devis['prix'],
        'dateReservation' => $dateReservation, 
        'dateChoisi' => $dateChoisi, 
        'idUser' => $idUser
    ]);

    $idReserve = $db->lastInsertId();

    if ($result) {
        if (count($idActivites)) {
            foreach ($idActivites as $idActivite) {
                $idHoraireActivite = $horairesSelectionnes[$idActivite['idActivite']];
                var_dump($idHoraireActivite);
                $q = "INSERT INTO horaireReserve (idReserve, idHoraires, dateChoisi) VALUES (:idReserve, :idHoraires, :dateChoisi)";
                $req = $db->prepare($q);
                $result = $req->execute([
                    'idReserve' => $idReserve,
                    'dateChoisi' => $dateChoisi,
                    'idHoraires' => $idHoraireActivite
                ]);
            }
        }

        if($result){
            $idHorRes = $db->lastInsertId();

            $q = "UPDATE reservation SET idHorRes = :idHorRes WHERE idReserve = :idReserve";
            $req = $db->prepare($q);

            $result = $req->execute([
                'idHorRes' => $idHorRes,
                'idReserve' => $idReserve
            ]);
        }

        foreach ($idActivites as $idActivite) {
            $q = "INSERT INTO activiteReserve (idReserve, idActivite) VALUES (:idReserve, :idActivite)";
            $req = $db->prepare($q);
            $result = $req->execute([
                'idReserve' => $idReserve,
                'idActivite' => $idActivite['idActivite']
            ]);
        }

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
        header('location: reserverDevis.php?message=Erreur.&type=error');
        exit;
    }
} else {
    header('location: reserverDevis.php?message=Veuillez cocher toutes les cases.&type=error');
    exit;
}


?>