<?php //TEST

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
include('includes/db.php'); 

$q = "SELECT idUser FROM REJOINT WHERE idEvent = :idEvent";
$req = $db->prepare($q);
$req->execute([
	'idEvent' => $_POST['idEvent']
]);

while($resultat = $req->fetch()){
  if($resultat['email'] == $_SESSION['email']){
  	header('location: event.php?message=Vous participez déjà à cet event.&type=danger');
  	exit;
  }
}
$q = "SELECT nbPlacesEvent FROM event WHERE idEvent = :idEvent";
$req = $db->prepare($q);
$req->execute([
	'idEvent' => $_POST['idEvent']
]);

$resultat = $req->fetch();
$q = "SELECT COUNT(idUser) AS nb FROM REJOINT WHERE idEvent = :idEvent";
$req2 = $db->prepare($q);
$req2->execute([
	'idEvent' => $_POST['idEvent']
]);

$resultat2 = $req2->fetch();
if($resultat2['nbPlacesEvent'] == $resultat['nbPlacesEvent']){
	header('location: event.php?message=Cet event est complet.&type=danger');
	exit;
}

$q = "INSERT INTO REJOINT (idEvent, idUser) VALUES (:idEvent, :idUser)";
$req = $db->prepare($q);
$reponse = $req->execute([
  'idEvent' => $_POST['idEvent'],
  'idUser' => $_POST['idUser'],
  'email' => $_SESSION['email']
]);

if ($reponse) {
	header('location: event.php?message=Vous avez rejoint l\'event.&type=success');
	exit;
} else {
	header('location: event.php?message=Echec vous n\'avez pas pu rejoindre l\'event.&type=danger');
	exit;
}

?>