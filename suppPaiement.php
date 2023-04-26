<?php
session_start();
require('includes/db.php');

$q = $db->prepare('SELECT idPaiement FROM paiement WHERE idPaiement = :idPaiement') ;
$q->execute(['idPaiement' => $_POST['idPaiement']]) ;
$paiement = $q->fetch();

 
$q = $db->prepare("DELETE FROM paiement WHERE idPaiement = :idPaiement");
$q->execute([
  'idPaiement' => $_POST['idPaiement']
]);

if ($q) {
	header('location: admin_paiement.php?message=Succès.&type=success');
	exit;
} else {
	header('location: admin_paiement.php?message=Echec.&type=danger');
	exit;
}
?>
