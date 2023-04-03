<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php include('includes/header.php') ?>

  <body>
    <main class="main" id="top">

	<?php include('includes/nav.php') ?>
      
<div class="container">

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

:root {
	--blue1: #ad1fff;
	--blue2: #44006b;
}

body, html {
	margin: 0;
	overflow: hidden;
	position: relative;
}

body {
	align-items: center;
	background-image: linear-gradient(to bottom right, var(--blue1), var(--blue2));
	color: #fff;
	display: flex;
	flex-direction: column;
	font-family: 'Roboto', sans-serif;
	justify-content: center;
	height: 100vh;
	text-align: center;
}

.container h1 {
	font-size: 10em;
	margin: 0 0 0.5em;
	line-height: 10px;
}

.container p {
	font-size: 1.2em;
	line-height: 26px;
}

.container small {
	opacity: 0.7;
}

.container a {
	color: #eee;
}

.circle {
	background-image: linear-gradient(to top right, var(--blue1), var(--blue2));
	border-radius: 50%;
	position: absolute;
	z-index: -1;
}

.circle.small {
	top: 200px;
	left: 150px;
	width: 100px;
	height: 100px;
}

.circle.medium {
	background-image: linear-gradient(to bottom left, var(--blue1), var(--blue2));
	bottom: -70px;
	left: 0;
	width: 200px;
	height: 200px;
}

.circle.big {
	top: -100px;
	right: -50px;
	width: 400px;
	height: 400px;
}

@media screen and (max-width: 480px) {
	.container h1 {
		font-size: 8em;
	}
	
	.container p {
		font-size: 1em;
	}
}

</style>

<?php

$status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
        403 => array('403 Forbidden', 'Le serveur a refusé de répondre à votre demande.'),
        404 => array('404 Not Found', 'Le document/fichier demandé n\'a pas été trouvé sur ce serveur.'),
        405 => array('405 Method Not Allowed', 'La méthode spécifiée dans la ligne de demande n\'est pas autorisée pour la ressource spécifiée.'),
        408 => array('408 Request Timeout', 'Votre navigateur n\'a pas réussi à envoyer une requête dans le temps imparti par le serveur.'),
        500 => array('500 Internal Server Error', 'La demande n\'a pas abouti en raison d\'une condition inattendue rencontrée par le serveur.'),
        502 => array('502 Bad Gateway', 'Le serveur a reçu une réponse invalide du serveur en amont alors qu\'il tentait de répondre à la demande.'),
        504 => array('504 Gateway Timeout', 'Le serveur en amont n\'a pas réussi à envoyer une requête dans le temps imparti par le serveur.'),
);

	
    $title = $codes[$status][0];
    $message = $codes[$status][1];
    if ($title == false || strlen($status) != 3) {
    $message = 'La page que vous avez demandé n\'est pas disponible.';
    }

    echo '<h1>'.$title.' </h1>
    <p>'.$message.'</p>';
	?>
	
	<small><a href="index.php" target="_blank">Page d'accueil</a></small>
	<div class="circle small"></div>
	<div class="circle medium"></div>
	<div class="circle big"></div>


</div>
