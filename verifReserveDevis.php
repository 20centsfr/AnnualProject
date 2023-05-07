<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');

$idSalle = $_POST['salles'];
$idHoraire = $_POST['horaires'][0];
$dateChoisi = $_POST['dateChoisi'];
$dateReservation = date('Y-m-d'); 
$idUser = $_POST['idUser'];
$idDevis = $_POST['idDevis'];


    $req = $db->query("SELECT * FROM devis WHERE idDevis='" . $idDevis . "'");
    while ($devis = $req->fetch()) {

    $activiteReq = $db->query("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis='" . $devis['idDevis'] . "'");
    echo '<td>';
    while ($activite = $activiteReq->fetch()) {
        $idActivite = $activite['idActivite'];
        echo '<input type="hidden" name="idActivite[]" value="'.$activite['idActivite'].'" >';
    }
}



/*
$idActivite = $_POST['$idActivite'][0];

if (isset($_POST['idDevis'])) {
    $idDevis = $_POST['idDevis'];
} else {
    var_dump([$idDevis]);
}

*/ 


$qq = "SELECT nbParticipants, prix FROM devis WHERE idDevis = ?";
$stmt = $db->prepare($qq);
if ($stmt->execute([$idDevis])) {
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbParticipants = $res['nbParticipants'];
    $prix = $res['prix'];
}


try {
    $qq = "SELECT nbParticipants, prix FROM devis WHERE idDevis = ?";
    $stmt = $db->prepare($qq);
    if ($stmt->execute([$idDevis])) {
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            $nbParticipants = $res['nbParticipants'];
            $prix = $res['prix'];
        } else {
            echo "pas trouvey.";
        }
    } else {
        echo "erreur.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
        header('location: reserverDevis.php?message=Erreur.');
        exit;
    }
} else {
    header('location: reserverDevis.php?message=Veuillez cocher les cases nécessaires.');
    exit;
}
?>