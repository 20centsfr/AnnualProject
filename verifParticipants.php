<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('includes/db.php');
session_start();

$idReservation = $_POST['idReserve'];
$nbParticipants = intval($_POST['nbParticipants']);
//var_dump(['nbParticipants']);

$participants = array();
for ($i = 0; $i < $nbParticipants; $i++) {
    $participant = array(
        'nom' => $_POST['nomParticipant'][$i],
        'prenom' => $_POST['prenomParticipant'][$i],
        'email' => $_POST['emailParticipant'][$i]
    );
    array_push($participants, $participant);
}

foreach ($participants as $participant) {
    $nom = $participant['nom'];
    $prenom = $participant['prenom'];
    $email = $participant['email'];

    $q = "INSERT INTO participants (prenom, nom, email, idReserve) VALUES (:nom, :prenom, :email, :idReserve)";
    $req = $db->prepare($q);
    $result = $req->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'idReserve' => $idReservation
    ]);

    if (!$result) {
        header('location: participants.php?message=Erreur.');
        exit;
    } else {
        header('location: paiement.php?message=Proceder au paiement');
        exit;
    }
}




/*include('includes/db.php');
session_start();

$idReservation = $_POST['idReserve'];
$idUser = $_POST['idUser'];
$participants = json_decode($_POST['participants'], true);
foreach ($participants as $participant) {
    $nom = $participant['nom'];
    $prenom = $participant['prenom'];
    $email = $participant['email'];
}

var_dump($participants);

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
} */
?>