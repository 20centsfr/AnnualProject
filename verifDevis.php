<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
include('includes/db.php'); 
include ('includes/connected.php');

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
	$prix += $row["tarifActivite"] * $nbParticipants;
}


foreach ($activites as $idActivite) {
	$select = $db->prepare("SELECT nomActivite, tarifActivite FROM activite WHERE idActivite = :idActivite");
	$select->execute(["idActivite" => $idActivite]);
	$row = $select->fetch();
	echo "- " . $row["nomActivite"] . " (" . $row["tarifActivite"] . "€)<br>";
}

//mat

$nomMateriel = $_POST["nomMateriel"];
$prixMateriel = $_POST["prixMateriel"];
$materiels = $_POST["materiels"];

if (empty($materiels)) {
	echo "Veuillez sélectionner au moins un materiel.";
} else {
 	$prixMat = 0; }

foreach ($materiels as $idMateriel) {
	$select = $db->prepare("SELECT prixMateriel FROM materiel WHERE idMateriel = :idMateriel");
	$select->execute(["idMateriel" => $idMateriel]);
	$row = $select->fetch();
	$prixMat += $row["prixMateriel"] * $nbParticipants;
}


foreach ($materiels as $idMateriel) {
	$select = $db->prepare("SELECT nomMateriel, prixMateriel FROM materiel WHERE idMateriel = :idMateriel");
	$select->execute(["idMateriel" => $idMateriel]);
	$row = $select->fetch();
	echo "- " . $row["nomMateriel"] . " (" . $row["prixMateriel"] . "€)<br>";
}

//prest

$nomPrestataire = $_POST["nomPrestataire"];
$service = $_POST["service"];
$prixService = $_POST["prixService"];
$prestataires = $_POST["prestataires"];

if (empty($prestataires)) {
	echo "Veuillez sélectionner au moins une activité.";
} else {
 	$prixPrest = 0; }

foreach ($prestataires as $idPrestataire) {
	$select = $db->prepare("SELECT prixService FROM prestataire WHERE idPrestataire = :idPrestataire");
	$select->execute(["idPrestataire" => $idPrestataire]);
	$row = $select->fetch();
	$prixPrest += $row["prixService"] * $nbParticipants;
}


foreach ($prestataires as $idPrestataire) {
	$select = $db->prepare("SELECT nomPrestataire, prixService FROM prestataire WHERE idPrestataire = :idPrestataire");
	$select->execute(["idPrestataire" => $idPrestataire]);
	$row = $select->fetch();
	echo "- " . $row["nomPrestataire"] . " (" . $row["prixService"] . "€)<br>";
}



echo "Prix total : " . $prix + $prixMat + $prixPrest . "€";

$idUser = $_SESSION['idUser'];

$q = 'INSERT INTO devis (nomEntreprise, nbParticipants, date, prix, idUser) VALUES (:nomEntreprise, :nbParticipants, :date, :prix, :idUser)';
$req = $db->prepare($q);
$reponse = $req->execute([
    'nomEntreprise' => $nomEntreprise,
    'nbParticipants' => $nbParticipants,
    'date' => $date,
    'prix' => $prix,
    'idUser' => $idUser /*,
	'idActivite' => $idActivite,
	'idPrestataire' => $idPrestataire,
	'idMateriel' => $idMateriel */
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
