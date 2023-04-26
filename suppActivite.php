<?php
session_start();
require('includes/db.php');

$q = $db->prepare('SELECT idActivite FROM activite WHERE idActivite = :idActivite') ;
$q->execute(['idActivite' => $_POST['idActivite']]) ;
$activite = $q->fetch();

$q = $db->prepare("DELETE FROM PARTICIPE WHERE idActivite = :idActivite");
$q->execute([
  'idActivite' => $_POST['idActivite']
]);
 
$q = $db->prepare("DELETE FROM activite WHERE idActivite = :idActivite");
$q->execute([
  'idActivite' => $_POST['idActivite']
]);

if ($q) {
	header('location: liste_asso.php?message=activite suprimée avec succès.&type=success');
	exit;
}else{
	header('location: liste_asso.php?message=Echec lors de la suppression de l activite.&type=danger');
	exit;
}
?>
