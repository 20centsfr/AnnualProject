<?php
  require_once('vendor/autoload.php');
  require_once('includes/db.php');
  require_once('lib/pdo_db.php');
  require_once('models/Customer.php');
  require_once('models/Transaction.php');

  \Stripe\Stripe::setApiKey('sk_test_51MlCKyFQeJjIkXikovqggUTmb0CsWW3vJzUgOfUPykHYDWF2PKqsOMzsTHhc5s2J63LV7UHzOBBWKoNPQsQItDIB00B3Y9pzuc');

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $prenom = $POST['prenom'];
 $nom = $POST['nom'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => 5000,
  "currency" => "usd",
  "description" => "Intro To React Course",
  "customer" => $customer->id
));


try {
	$db = new PDO('mysql:host=localhost;port=3306;dbname=ts', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch(Exception $e) {
	die('Erreur : ' . $e->getMessage()); 
}

$res = 0;
$q = $bdd->query('SELECT idUser FROM user WHERE email ="' . $POST['email'] . '"');
$res = $q->fetch(PDO::FETCH_ASSOC);

$idUser = $res['idUser'];



// Customer Data
$customerData = [
  'id' => $charge->customer,
  //'idUser' => $idUser,
  'prenom' => $prenom,
  'nom' => $nom,
  'email' => $email
];

// Instantiate Customer
$customer = new Customer();

// Add Customer To DB
$customer->addCustomer($customerData);


// Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
];

// Instantiate Transaction
$transaction = new Transaction();

// Add Transaction To DB
$transaction->addTransaction($transactionData);

// Redirect to success
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);