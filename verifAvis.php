<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

include('includes/db.php'); 

$entreprise = $_POST["entreprise"];
$avis = $_POST["avis"];

if(empty($_POST['entreprise']) || empty($_POST['avis'])){
    header('location: avis.php?message=Vous devez remplir les 2 champs');  
    exit;
}


$idUser = $_SESSION['idUser'];

$q = "INSERT INTO avis (entreprise, avis, idUser) VALUES (:entreprise, :avis, :idUser)";
$req = $db->prepare($q);
$reponse = $req->execute([
    'avis' => $_POST["avis"],
    'entreprise' => $_POST["entreprise"],
    'idUser' => $idUser
]);

if ($reponse) {
    header('location: index.php?message=Succes.&type=success');
    exit;
} else {
    header('location: avis.php?message=Echec.&type=danger');
    exit;
}
