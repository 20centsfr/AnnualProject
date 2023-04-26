<?php
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$nomMateriel = $_POST['nomMateriel'];
$quantiteMateriel = $_POST['quantiteMateriel'];
$typeMateriel = $_POST['typeMateriel'];


$q = "INSERT INTO materiel (nomMateriel, quantiteMateriel, typeMateriel) VALUES (:nomMateriel, :quantiteMateriel, :typeMateriel)";
$req = $db->prepare($q);
$req->execute([
    'nomMateriel' => $nomMateriel,
    'quantiteMateriel' => $quantiteMateriel,
    'typeMateriel' => $typeMateriel
]);

if ($req) {
    header('location: admin_materiels.php?message=Materiel ajouté');
    exit;
} else {
    header('location:admin_materiels.php?message=Erreur.');
}

?>
