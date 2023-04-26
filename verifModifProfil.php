<?php
include 'includes/db.php';
session_start();


    if( !isset($_POST['email']) || empty($_POST['email']) ||
        !isset($_POST['nom']) || empty($_POST['nom']) ||
        !isset($_POST['prenom']) || empty($_POST['prenom']) ||
        !isset($_POST['entreprise']) || empty($_POST['entreprise'])  ) {
        header('location:modifProfile.php?message=Veuillez remplir tous les champs.');
        exit;
    }

    $email = htmlspecialchars($_POST['email']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $entreprise = htmlspecialchars($_POST['entreprise']);

    $actualEmail = $_SESSION['email'];


if($email == $actualEmail){
    $q = "UPDATE user SET prenom=:prenom, nom=:nom, entreprise=:entreprise WHERE email='$actualEmail' ";
    $req = $db->prepare($q);
    $req->execute( [
        'prenom'=>$prenom,
        'nom'=>$nom,
        'entreprise'=>$entreprise
    ]);

    if ($req) {
        header('location:modifProfile.php?message=Informations modifiées avec succès');
        exit;
    } else {
        header('location:modifProfile.php?message=Erreur.');
    }
}


$q = "SELECT idUser FROM user WHERE email = :email";
$req = $db->prepare($q);
$req->execute([
    'email' => $email
]);

$resultat = $req->fetch();
if($resultat){
    header('location:modifProfile.php?message=Email déjà utilisé.&type=danger');
    exit;
}
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        header('location:modifProfile.php?message=Email invalide.&type=danger');
        exit;
    }


    $q = "UPDATE user SET prenom=:prenom, nom=:nom, email=:email, entreprise=:entreprise WHERE email='$actualEmail' ";
    $req = $db->prepare($q);
    $req->execute( [
        'prenom'=>$prenom,
        'nom'=>$nom,
        'email'=>$email,
        'entreprise'=>$entreprise
    ]);

    if ($req) {
        $_SESSION['email'] = $email;
        header('location:modifProfile.php?message=Informations modifiées avec succès');
        exit;
    } else {
        header('location:modifProfile.php?message=Erreur.');
    }
