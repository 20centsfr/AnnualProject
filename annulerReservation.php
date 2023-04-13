<?php //test

require('includes/db.php');
$idUser = $_POST['idUser'];
$idActivite = $_POST['idActivite'];


$q = "DELETE FROM reserve WHERE idUser = '$idUser' AND idActivite = '$idActivite'";
$req = $db->prepare($q);
$reponse = $req->execute([
]);

if($reponse){
	header('location: reservations.php?message=Vous avez quitté l\'activité.&type=success');
	exit;
} else {
	header('location: reservations.php?message=Echec, vous n\'avez pas quitté l\'activité.&type=danger');
	exit;
}

?>
