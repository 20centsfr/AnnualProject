<?php

session_start();
require_once('includes/db.php');
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51MlCKyFQeJjIkXikovqggUTmb0CsWW3vJzUgOfUPykHYDWF2PKqsOMzsTHhc5s2J63LV7UHzOBBWKoNPQsQItDIB00B3Y9pzuc');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = $_POST['stripeToken'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $date = date('Y-m-d'); 

  $prix = $_SESSION['prix']* 100;

  $customer = \Stripe\Customer::create(array(
    'email' => $email,
    'name' => $first_name . ' ' . $last_name,
    'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'amount' => $prix,
      'currency' => 'eur',
      'description' => 'Example charge',
      'customer' => $customer->id
  ));


  $mysqli = new mysqli("localhost", "root", "root", "ts");

  if ($mysqli->connect_errno) {
    echo "Erreur: " . $mysqli->connect_error;
    exit();
  }
  
  $stmt = $mysqli->prepare("INSERT INTO paiement (nom, prenom, email, montant, date) VALUES (?, ?, ?, ?, ?)");

  $stmt->bind_param("sssis", $first_name, $last_name, $email, $prix, $date);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    echo "Succes.";
  } else {
    echo "Erreur.";
  }

  $stmt->close();
  $mysqli->close();

  header('Location: mail.php?message=Paiement réussi !&type=success');
  exit;
}
?> 