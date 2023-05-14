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

    $select = $db->prepare('SELECT idParticipants FROM participants WHERE email = :email');
    $select->execute(['email' => $email]);
    $content = $select->fetch(PDO::FETCH_ASSOC);

    if(!$content){
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
    }else{
        $q = "UPDATE participants SET idReserve = :idReserve WHERE email = :email";
        $req = $db->prepare($q);
        $exec = $req->execute([
            'idReserve' => $idReservation,
            'email' => $email
        ]);
    }

}


echo "<form id='hidden-form' method='POST' action='recap.php' style='display:none;'>";
echo "<input type='hidden' name='idReserve' value='" . $idReservation . "'>";
echo "</form>";
echo "<script>document.getElementById('hidden-form').submit();</script>";
exit;


?>