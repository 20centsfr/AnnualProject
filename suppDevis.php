<?php //todo

require('includes/db.php');
$idUser=$_POST['idUser'];


$q = "DELETE FROM devis WHERE idUser= '$idUser'";
$req = $db->prepare($q);
$reponse = $req->execute([
	'idUser' => $_POST['idUser']
]);

if($reponse){

	header('location: devis.php?message=Vous avez annulé le devis.&type=success');
	exit;
}else{
	header('location: devis.php?message=Echec.&type=danger');
	exit;
}

?>