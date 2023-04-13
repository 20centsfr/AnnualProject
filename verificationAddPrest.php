<?php
include 'includes/db.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$nomPrestataire = $_POST['nomPrestataire'];
$emailPrestataire = $_POST['emailPrestataire'];
$service = $_POST['service'];
$prixService = $_POST['prixService'];
$secteurActivite = $_POST['secteurActivite'];


$q = "INSERT INTO prestataire (nomPrestataire, emailPrestataire, service, prixService, secteurActivite) VALUES (:nomPrestataire, :emailPrestataire, :service, :prixService, :secteurActivite)";
$req = $db->prepare($q);
$req->execute([
    'nomPrestataire' => $nomPrestataire,
    'emailPrestataire' => $emailPrestataire,
    'service' => $service,
    'prixService' => $prixService,
    'secteurActivite' => $secteurActivite
]);

if ($req) {
    header('location: admin_prest.php?message=Lieu ajouté');
    exit;
} else {
    header('location:admin_prest.php?message=Erreur.');
}

?>
