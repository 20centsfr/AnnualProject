<!DOCTYPE html>
<html lang="en">
<head>
<?php

include 'includes/db.php';
include 'includes/header.php';

session_start();

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
  <?php include('includes/nav.php'); ?>

  <section class="container">
    <h1 class="my-4 text-center">Insérez vos informations bancaires</h1><br>
    <h3>Montant à payer : <?php echo $prix = $_SESSION['prix'];?>€</h3><br>
    <form action="charge.php" method="post" id="payment-form">
      <div class="form-row">
        <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prenom">
        <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom">
        <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email">
        <input type="text" name="entreprise" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Entreprise">
        <div id="card-element" class="form-control"></div>
        <div id="card-errors" role="alert"></div><br><br>
      </div>
      <button type="submit" class="btn btn-primary btn-block mb-4">Procéder au paiement</button>
    </form>
  </div>
</section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="scripts/charge.js"></script>
</main>
</body>
</html>