<?php

require_once 'includes/db.php';

if(!isset($_POST['nomActivite']) || empty($_POST['nomActivite']) || !isset($_POST['descriptionActivite']) || empty($_POST['descriptionActivite']) || !isset($_POST['nbPlacesActivite']) || empty($_POST['nbPlacesActivite']) || !isset($_POST['typeActivite']) || empty($_POST['typeActivite']) || !isset($_POST['tarifActivite']) || empty($_POST['tarifActivite'])) {
	header('location:addActivite.php?message=Veuillez remplir tous les champs.');
	exit;
}


$q = "SELECT nomActivite FROM activite WHERE nomActivite = :nomActivite";
$req = $db->prepare($q);
$req->execute([
	'nomActivite' => $_POST['nomActivite']
]);

$resultat = $req->fetch();
if($resultat){
	header('location: addActivite.php?message=Ce nom d\'activite est déjà uilisé.&type=danger');
	exit;
}


$q = "INSERT INTO activite (nomActivite, descriptionActivite, nbPlacesActivite, tarifActivite) VALUES (:nomActivite, :descriptionActivite, :nbPlacesActivite, :tarifActivite)";
$req = $db->prepare($q);
$reponse = $req->execute([
  'nomActivite' => $_POST['nomActivite'],
  'descriptionActivite' => $_POST['descriptionActivite'],
  'nbPlacesActivite' => $_POST['nbPlacesActivite'],
  'tarifActivite' => $_POST['tarifActivite']
]);

if ($reponse) {
	header('location: addActivite.php?message=Activité créée avec succès.&type=success');
	exit;
} else {
	header('location: addActivite.php?message=Echec lors de la création de l\'activite.&type=danger');
	exit;
}

?>
