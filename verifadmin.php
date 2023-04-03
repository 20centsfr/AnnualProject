<?php
require_once 'includes/db.php';

 if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
  $statement = $db->query('SELECT admin FROM user WHERE email ="'.$_SESSION['email'].'"');
  $reponse = $statement->fetch(PDO::FETCH_ASSOC);
}

?>
