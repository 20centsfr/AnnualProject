<?
include 'db.php';
session_start();

$q = $db->query('SELECT prenom, nom, email, entreprise FROM user WHERE email = "' . $_SESSION['email'] . '"');
$userInfo = $q->fetch();