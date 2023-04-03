<!DOCTYPE html>
<html lang="en">
<head>
<?php

include 'includes/db.php';
include 'includes/header.php';

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function getIp(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
  if(isset($_SESSION['email'])){

  $ip=getIp();
  $date=Date('Y-m-d');
  $heure=Date("H:i:s");
  $page="Paiement";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  }
?>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <main>
  <div class="container">
  <?php include('includes/nav.php') ?>
    <h2 class="my-4 text-center">Insérez vos informations bancaires</h2>
    <form action="./charge.php" method="post" id="payment-form">
      <div class="form-row">
        <input type="text" name="prenom" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prenom">
        <input type="text" name="nom" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom">
        <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email">
        <input type="password" name="mdp" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Mot de passe">
        <div id="card-element" class="form-control"></div>
        <div id="card-errors" role="alert"></div>
      </div>
      <button>Procéder au paiement</button>
    </form>
  </div>

  <script src="https://js.stripe.com/v3/"></script>
  <script src="js/charge.js"></script>
</main>
</body>
</html>