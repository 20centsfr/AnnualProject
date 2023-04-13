<?php
session_start();
require('includes/db.php');
include ('includes/connected.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);



if(isset($_POST["idUser"])) {
	$idUser = htmlspecialchars($_POST['idUser']);
	echo $idUser;
	var_dump($_POST['idUser']);
	foreach($POST as $key => $value) {
		if(strpos($key, 'idActivite') === 0) {
		  $idActivite = substr($key, 11);
		}
	}

} else {
	header('location: activites.php?message=NONNNNNN.&type=danger');
	var_dump($_POST['idUser']);
  	exit;
}

var_dump($idActivite);

$q = "SELECT idUser FROM reserve WHERE idActivite = :idActivite";
$req = $db->prepare($q);
$req->execute([
	'idActivite' => $_POST['idActivite']
]);

while($resultat = $req->fetch()){
  if($resultat['idUser'] == $_SESSION['idUser']){
  	header('location: activites.php?message=Vous avez déjà réservé cette activité.&type=danger');
  	exit;
  }
}

$q = "INSERT INTO reserve (idActivite, idUser) VALUES (:idActivite, :idUser)";
$req = $db->prepare($q);
$reponse = $req->execute([
  'idActivite' => $idActivite,
  'idUser' => $idUser
]);

if ($reponse) {
	header('location: activites.php?message=Vous avez reservé l\'activité.&type=success');
	exit;
} else {
	header('location: activites.php?message=Echec.&type=danger');
	exit;
}

?>
