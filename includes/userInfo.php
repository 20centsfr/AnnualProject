<?
include 'db.php';
session_start();

$q = $db->query('SELECT prenom, nom, email, entreprise, nbPoints FROM user WHERE email = "' . $_SESSION['email'] . '"');
$userInfo = $q->fetch();

$q = $db->query('SELECT idUser FROM user WHERE email = "' . $_SESSION['email'] . '"');
$userId = $q->fetch();

$idUser = $userId['idUser'];

?>