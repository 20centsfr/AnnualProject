<?php
include('includes/db.php');
session_start();
include ('includes/connected.php');

$idActivites = $_POST['idActivite'];
$horairesSelectionnes = array();
foreach($idActivites as $idActivite){
    $horairesSelectionnes[$idActivite] = $_POST['horaires_'.$idActivite];
}

var_dump($_POST['horaires_'.$idActivite]);

var_dump($idHoraire = $horairesSelectionnes[$idActivites[0]]);
var_dump($dateChoisi = $_POST['dateChoisi']);
var_dump($dateReservation = date('Y-m-d')); 
var_dump($idUser = htmlspecialchars($_POST['idUser']));
var_dump($idDevis = htmlspecialchars($_POST['idDevis']));

$devisReq = $db->prepare("SELECT * FROM devis WHERE idDevis = ?");
$devisReq->execute([$idDevis]);
$devis = $devisReq->fetch();

$idActivites = array();
$activiteReq = $db->prepare("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis = ?");
$activiteReq->execute([$idDevis]);
while ($activite = $activiteReq->fetch()) {
    $idActivites[] = $activite['idActivite'];
}

if (!empty($idHoraire)) {
    $q = "INSERT INTO reservation (idHoraires, nbParticipants, prix, dateReservation, dateChoisi, idUser) VALUES (:idHoraires, :nbParticipants, :prix, :dateReservation, :dateChoisi, :idUser)";
    $req = $db->prepare($q);

    $result = $req->execute([
        'idHoraires' => $idHoraire,
        'nbParticipants' => $devis['nbParticipants'],
        'prix' => $devis['prix'],
        'dateReservation' => $dateReservation, 
        'dateChoisi' => $dateChoisi, 
        'idUser' => htmlspecialchars($idUser)
    ]);

    $idReserve = $db->lastInsertId();

    if ($result) {
        if (count($idActivites) > 1) {
            foreach ($idActivites as $idActivite) {
                $idHoraireActivite = $horairesSelectionnes[$idActivite];
                $q = "INSERT INTO horaireReserve (idReserve, idHoraires, dateChoisi) VALUES (:idReserve, :idHoraires, :dateChoisi)";
                $req = $db->prepare($q);
                $result = $req->execute([
                    'idReserve' => $idReserve,
                    'dateChoisi' => $dateChoisi,
                    'idHoraires' => $idHoraireActivite
                ]);
            }
        } else {
            $idHoraireActivite = $horairesSelectionnes[$idActivites[0]];
            $q = "INSERT INTO horaireReserve (idReserve, idHoraires, dateChoisi) VALUES (:idReserve, :idHoraires, :dateChoisi)";
            $req = $db->prepare($q);
            $result = $req->execute([
                'idReserve' => $idReserve,
                'dateChoisi' => $dateChoisi,
                'idHoraires' => $idHoraireActivite
            ]);
        }

        foreach ($idActivites as $idActivite) {
            $q = "INSERT INTO activiteReserve (idReserve, idActivite) VALUES (:idReserve, :idActivite)";
            $req = $db->prepare($q);
            $result = $req->execute([
                'idReserve' => $idReserve,
                'idActivite' => $idActivite
            ]);
        }

        if ($result) {
            echo "<form id='hidden-form' method='POST' action='participants.php' style='display:none;'>";
            echo "<input type='hidden' name='idReserve' value='" . $idReserve . "'>";
            echo "</form>";
            echo "<script>document.getElementById('hidden-form').submit();</script>";
            exit;
        } else {
            //header('location: reserverDevis.php?message=Erreur.&type=error');
            //exit;
        }
    } else {
        //header('location: reserverDevis.php?message=Erreur.&type=error');
        exit;
    }
} else {
    //header('location: reserverDevis.php?message=Veuillez cocher toutes les cases.&type=error');
    //exit;
}


?>