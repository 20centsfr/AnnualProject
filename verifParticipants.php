<?php
include('includes/db.php');
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

/* if (!empty($idParticipant)) {
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