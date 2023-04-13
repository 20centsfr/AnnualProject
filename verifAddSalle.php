<?php
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$numSalle = $_POST['numSalle'];
$dispoSalle = $_POST['dispoSalle'];
$nbPlaceSalle = $_POST['nbPlaceSalle'];


$q = "INSERT INTO salle (numSalle, dispoSalle, nbPlaceSalle) VALUES (:numSalle, :dispoSalle, :nbPlaceSalle)";
$req = $db->prepare($q);
$req->execute([
    'numSalle' => $numSalle,
    'dispoSalle' => $dispoSalle,
    'nbPlaceSalle' => $nbPlaceSalle
]);

if ($req) {
    header('location: admin_salles.php?message=Lieu ajouté');
    exit;
} else {
    header('location:admin_salles.php?message=Erreur.');
}

?>
