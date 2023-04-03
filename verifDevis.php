<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
include('includes/db.php'); 

$date=Date('Y-m-d');
$nomEntreprise = $_POST["nomEntreprise"];
$nbParticipants = $_POST["nbParticipants"];
$activites = $_POST["activites"];

if (empty($activites)) {
	echo "Veuillez sélectionner au moins une activité.";
} else {
 	$prix = 0; 

foreach ($activites as $idActivite) {
	$select = $db->prepare("SELECT tarifActivite FROM activite WHERE idActivite = :idActivite");
	$select->execute(["idActivite" => $idActivite]);
	$row = $select->fetch();
	$prix += $row["tarifActivite"];
}


foreach ($activites as $idActivite) {
	$select = $db->prepare("SELECT nomActivite, tarifActivite FROM activite WHERE idActivite = :idActivite");
	$select->execute(["idActivite" => $idActivite]);
	$row = $select->fetch();
	echo "- " . $row["nomActivite"] . " (" . $row["tarifActivite"] . "€)<br>";
}

echo "Prix total : " . $prix . "€";

$idUser = $_SESSION['idUser'];

$q = 'INSERT INTO devis (nomEntreprise, nbParticipants, date, prix, idUser) VALUES (:nomEntreprise, :nbParticipants, :date, :prix, :idUser)';
$req = $db->prepare($q);
$reponse = $req->execute([
    'nomEntreprise' => $nomEntreprise,
    'nbParticipants' => $nbParticipants,
    'date' => $date,
    'prix' => $prix,
    'idUser' => $idUser
]);

if ($reponse) {
	header('location: reservations.php?message=Succes.&type=success');
	exit;
} else {
	header('location: devis.php?message=Echec.&type=danger');
	exit;
}

}

?>

