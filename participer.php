<?php
session_start();
require('includes/db.php');

$q = "SELECT idUser FROM participe WHERE idEvent = :idEvent";
$req = $db->prepare($q);
$req->execute([
	'idEvent' => $_POST['idEvent']
]);

while($resultat = $req->fetch()){
  if($resultat['email'] == $_SESSION['email']){
  	header('location: events.php?message=Vous participez déjà à cet event.&type=danger');
  	exit;
  }
}

$q = "SELECT nbPlacesEvent FROM event WHERE idEvent = :idEvent";
$req = $db->prepare($q);
$req->execute([
	'idEvent' => $_POST['idEvent']
]);

$resultat = $req->fetch();
$q = "SELECT COUNT(idUser)AS nb FROM participe WHERE idEvent = :idEvent";
$req2 = $db->prepare($q);
$req2->execute([
	'idEvent' => $_POST['idEvent']
]);

$resultat2 = $req2->fetch();
if($resultat2['nb'] == $resultat['nbPlacesEvent']){
	header('location: events.php?message=Cet event est complet.&type=danger');
	exit;
}

$q = "INSERT INTO participe (idEvent, idUser) VALUES (:idEvent, :idUser)";
$req = $db->prepare($q);
$reponse = $req->execute([
  'idEvent' => $_POST['idEvent'],
  'idUser' => $_POST['idUser']
]);

if ($reponse) {
	header('location: events.php?message=Succès.&type=success');
	exit;
} else {
	header('location: events.php?message=Echec.&type=danger');
	exit;
}

?>
