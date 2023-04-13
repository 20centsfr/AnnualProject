<?php

try{
	$db = new PDO('mysql:host=localhost;port=3306;dbname=ts', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(Exception $e){
	die('Erreur : ' . $e->getMessage()); 
}

?>