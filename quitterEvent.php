<?php //TEST
session_start();
require('includes/db.php');

$q = $db->prepare("DELETE FROM REJOINT WHERE idUser = :idUser AND idEvent = :idEvent");
$q->execute([
  'idUser' => $_SESSION['idUser'],
  'idEvent' => $_POST['idEvent']
]);

if ($q) {
	header('location: accueil.php?message=Vous avez quitté l\'evenement.&type=success');
	exit;
}else{
	header('location: accueil.php?message=Echec, vous n\'avez pas quitté l\'evenement.&type=danger');
	exit;
}
?>
