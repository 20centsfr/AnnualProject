<?php

include('includes/db.php');
session_start();

$idReservation = $_POST['idReserve'];
//$nbParticipants = intval($_POST['nbParticipants']);

if (isset($_POST['nbParticipants'])) {
    $nbParticipants = $_POST['nbParticipants'];
} else {
    var_dump([$nbParticipants]);
}


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
        header('location:participants.php?message=Erreur.');
        exit;
        
    }
}

header('location:recap.php?message=Succès');
exit;


?>