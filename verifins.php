<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'includes/db.php';


if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	header('location: inscription.php?message=Email invalide.');
	exit;
}

if(empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['entreprise']) || empty($_POST['mdp']) || empty($_POST['mdp2'])){
	header('location: inscription.php?message=Vous devez remplir tous les champs.');
	exit;
}

if(strlen($_POST['mdp']) < 8){
	header('location: inscription.php?message=Le mot de passe doit faire au moins 8 caractères.');
	exit;
}

if($_POST['mdp'] != $_POST['mdp2']){
	header('location: inscription.php?message=Veuillez saisir un mot de passe identique pour les 2 champs.');
	exit;
}

include('includes/db.php');

$q = 'SELECT idUser FROM user WHERE email = ?';
$req = $db->prepare($q);
$req->execute([$_POST['email']]);

$results = $req->fetchAll(); 

if(count($results) != 0){
	header('location: inscription.php?message=Cet email est déjà utilisé.');
	exit;
}

$q = 'INSERT INTO user (prenom, nom, entreprise, email, mdp, admin) VALUES (:prenom, :nom, :entreprise, :email, :mdp, :admin)';
$req = $db->prepare($q);
$result = $req->execute([
		'prenom' => $_POST['prenom'],
		'nom' => $_POST['nom'],
		'entreprise' => $_POST['entreprise'],
		'email' => $_POST['email'],
		'mdp' => hash('sha512', $_POST['mdp']),
		'admin' => 0
	]);


if($result){
	header('location: connexion.php?message=Compte créé avec succès');
	exit;
} else {
	header('location: inscription.php?message=Erreur lors de l\'inscription.');
	exit;
}

?>