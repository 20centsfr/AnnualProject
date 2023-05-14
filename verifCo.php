<?php
include('includes/db.php'); 

	if(isset($_POST['email']) && !empty($_POST['email'])){
		setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
	}
 
	if(empty($_POST['email']) || empty($_POST['mdp'])){
		header('location: connexion.php?message=Vous devez remplir les 2 champs&type=danger');  
		exit;
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		header('location: connexion.php?message=Email invalide'); 
		exit;
	}


	$q = 'SELECT idUser, banni FROM user WHERE email = :email AND mdp = :mdp';
	$req = $db->prepare($q);
	$req->execute([
			'email' => $_POST['email'],
			'mdp' => hash('sha512', $_POST['mdp'])
		]);
	$results = $req->fetchAll(); 

	if(count($results) == 0){
		header('location: connexion.php?message=Identifiants incorrects&type=danger'); 
		exit;
	}

	session_start();
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['idUser'] = $results[0]['idUser'];

	if($results[0]['banni']){
		$_SESSION['banni'] = 1;
	}

	header('location: index.php');
	exit;
	
?>
