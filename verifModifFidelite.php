<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
include('includes/db.php'); 

$nomFidelite = $_POST['nomFidelite'];
$description = $_POST['description'];
$date = $_POST['date'];
$points = $_POST['points'];


$q = "INSERT INTO fidelite (nomFidelite, description, points, date) VALUES (:nomFidelite, :description, :points, :date)";
$req = $db->prepare($q);
$req->execute([
    'nomFidelite' => $nomFidelite,
    'description' => $description,
    'points' => $points,
    'date' => $date
]);

if ($req) {
    header('location: admin_fidelite.php?message=Offre ajouté.');
    exit;
} else {
    header('location:admin_fidelite.php?message=Erreur.');
}

?>