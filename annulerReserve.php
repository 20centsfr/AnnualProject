<?php //test

require('includes/db.php');
include ('includes/connected.php');
$idUser = $_POST['idUser'];
$idReserve = $_POST['idReserve'];


$q = "DELETE FROM reservation WHERE idUser = '$idUser' AND idReserve = '$idReserve'";
$req = $db->prepare($q);
$reponse = $req->execute([
]);

if($reponse){
	header('location: reservations.php?message=Vous avez annulé la reservation.&type=success');
	exit;
} else {
	header('location: reservations.php?message=Echec.&type=danger');
	exit;
}

?>
