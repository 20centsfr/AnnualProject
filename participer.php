<?php
include 'includes/db.php';
session_start();
require('includes/db.php');
include ('includes/connected.php');

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
	  	header('location: activites.php?message=Vous participez déjà à cet event.&type=danger');
	  	exit;
	  }
	}

	$q = "SELECT nbPlacesEvent FROM event WHERE idEvent = :idEvent";
	$req = $db->prepare($q);
	$req->execute([
		'idEvent' => $idEvent
	]);

	/*
	$resultat = $req->fetch();
	$q = "SELECT COUNT(idUser) AS nb FROM participe WHERE idEvent = :idEvent";
	$req2 = $db->prepare($q);
	$req2->execute([
		'idEvent' => $_POST['idEvent']
	]);

	$resultat2 = $req2->fetch();
	if($resultat2['nb'] == $resultat['nbPlacesEvent']){
		header('location: activites.php?message=Cet event est complet.&type=danger');
		exit;
	} 
	*/

	$q = "INSERT INTO participe (idEvent, idUser) VALUES (:idEvent, :idUser)";
	$req = $db->prepare($q);
	$reponse = $req->execute([
	  'idEvent' => $idEvent,
	  'idUser' => $idUser
	]);

	if ($reponse) {
		header('location: activites.php?message=Succès.&type=success');
		exit;
	} else {
		header('location: activites.php?message=Echec.&type=danger');
		exit;
	}
} else {
	header('location: activites.php?message=Erreur.&type=danger');
	exit;
}
?>