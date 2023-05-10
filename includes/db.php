<?php
/*
try{
	$db = new PDO('mysql:host=localhost;port=3306;dbname=ts', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(Exception $e){
	die('Erreur : ' . $e->getMessage()); 
}

*/

try {
	$db = new PDO('mysql:host=64.226.72.114;port=3306;dbname=ts', 'together', 'projetannuel', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(Exception $e) {
	die('Erreur : ' . $e->getMessage()); 
}

?>
