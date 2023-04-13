<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

include('includes/db.php'); 

$email = $_POST["email"];
$message = $_POST["message"];

if(empty($_POST['email']) || empty($_POST['message'])){
    header('location: contact.php?message=Vous devez remplir les 2 champs');  
    exit;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    header('location: contact.php?message=Email invalide'); 
    exit;
}

$idUser = $_SESSION['idUser'];

$q = "UPDATE user SET message = :message WHERE idUser = :idUser";
$req = $db->prepare($q);
$reponse = $req->execute([
    'message' => $_POST["message"],
    'idUser' => $idUser
]);

if ($reponse) {
    header('location: contact.php?message=Succes.&type=success');
    exit;
} else {
    header('location: contact.php?message=Echec.&type=danger');
    exit;
}
