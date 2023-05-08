<?php
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if (isset($_POST['idEvent']) && isset($_POST['idUser'])) {
	$idEvent = $_POST['idEvent'];
	$idUser = $_POST['idUser'];

	$q = "SELECT idUser FROM participe WHERE idEvent = :idEvent";
	$req = $db->prepare($q);
	$req->execute([
		'idEvent' => $idEvent
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
		'idEvent' => $idEvent
	]);


	$q = "INSERT INTO participe (idEvent, idUser) VALUES (:idEvent, :idUser)";
	$req = $db->prepare($q);
	$reponse = $req->execute([
	  'idEvent' => $idEvent,
	  'idUser' => $idUser
	]);

	if ($reponse) {
		header('location: events.php?message=Succès.&type=success');
		exit;
	} else {
		header('location: events.php?message=Echec.&type=danger');
		exit;
	}
} else {
	header('location: events.php?message=Erreur.&type=danger');
	exit;
}
?>