<?php
include 'includes/db.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$nomLieu = $_POST['nomLieu'];
$adresse = $_POST['adresse'];
$codePostal = $_POST['codePostal'];
$villeLieu = $_POST['villeLieu'];


$q = "INSERT INTO lieu (nomLieu, adresse, codePostal, villeLieu) VALUES (:nomLieu, :adresse, :codePostal, :villeLieu)";
$req = $db->prepare($q);
$req->execute([
    'nomLieu' => $nomLieu,
    'adresse' => $adresse,
    'codePostal' => $codePostal,
    'villeLieu' => $villeLieu
]);

if ($req) {
    header('location: admin_salles.php?message=Lieu ajouté');
    exit;
} else {
    header('location:admin_salles.php?message=Erreur.');
}

?>
