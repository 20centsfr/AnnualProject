<?php 
include 'includes/db.php';
include 'includes/userInfo.php';
session_start();
if(isset($_SESSION['email'])) {
  //$idUser = $_SESSION['idUser'];
  $q = "SELECT banni FROM user WHERE idUser = $idUser";
  $resultat = $db->query($q);
  $userId = $resultat->fetch();
  if($userId['banni'] == 1) {
    header('Location: banPage.php');
    exit();
  }
}

?>