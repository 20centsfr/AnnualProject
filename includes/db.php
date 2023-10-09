<?php

try {
	$db = new PDO('mysql:host=..;port=3306;dbname=..', '..', '..', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(Exception $e) {
	die('Erreur : ' . $e->getMessage()); 
}

?>
