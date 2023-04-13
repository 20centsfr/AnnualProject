<?php //TEST
session_start();
require('includes/db.php');

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
?>
