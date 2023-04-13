<?php //todo

require_once 'includes/db.php';
include ('includes/connected.php');


if(!isset($_POST['nomEvent']) || empty($_POST['nomEvent']) || !isset($_POST['descriptionEvent']) || empty($_POST['descriptionEvent']) ||  !isset($_POST['heureEvent']) || empty($_POST['heureEvent']) || !isset($_POST['dateEvent']) || empty($_POST['dateEvent']) || !isset($_POST['nbPlacesEvent']) || empty($_POST['nbPlacesEvent']) || !isset($_POST['lieuEvent']) || empty($_POST['lieuEvent'])) {
    header('location:addEvent.php?message=Veuillez remplir tous les champs.');
    exit;
}


$q = "SELECT nomEvent FROM event WHERE nomEvent = :nomEvent";
$req = $db->prepare($q);
$req->execute([
    'nomEvent' => $_POST['nomEvent']
]);

$resultat = $req->fetch();
if($resultat){
    header('location: addEvent.php?message=Ce nom d\'event est déjà uilisé.&type=danger');
    exit;
}


$q = "INSERT INTO event (nomEvent, descriptionEvent, heureEvent, dateEvent, lieuEvent) VALUES (:nomEvent, :descriptionEvent, :heureEvent, :dateEvent, :lieuEvent)";
$req = $db->prepare($q);
$reponse = $req->execute([
    'nomEvent' => $_POST['nomEvent'],
    'descriptionEvent' => $_POST['descriptionEvent'],
    'heureEvent' => $_POST['heureEvent'],
    'dateEvent' => $_POST['dateEvent'],
    'nbPlacesEvent' => $_POST['nbPlacesEvent'],
    'lieuEvent' => $_POST['lieuEvent']
]);

if ($reponse) {
    header('location: addEvent.php?message=event créé avec succès.&type=success');
    exit;
} else {
    header('location: addEvent.php?message=Echec lors de la création de l\'event.&type=danger');
    exit;
}

?>
