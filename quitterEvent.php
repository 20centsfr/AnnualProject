<?php 
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


$q = $db->prepare("DELETE FROM participe WHERE idUser = :idUser AND idEvent = :idEvent");
$q->execute([
  'idUser' => $_SESSION['idUser'],
  'idEvent' => $_POST['idEvent']
]);

if ($q) {
	header('location: reservations.php?message=Vous avez quitté l\'evenement.&type=success');
	exit;
}else{
	header('location: reservations.php?message=Echec, vous n\'avez pas quitté l\'evenement.&type=danger');
	exit;
}

//QUOICOUBAE
?>
