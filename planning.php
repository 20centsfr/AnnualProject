<!DOCTYPE html>

<div class="app-container">


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
  $page="Planning";

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

<html>
<link href="assets/css/style.css" rel="stylesheet" />
    <body>
    <?php include('includes/nav.php') ?>

    <main>
    <section class="container">
    <div class="app-content">
      <div class="plans-section">
        <div class="plans-section-header">
          <p>Planning</p>
          <p class="time">
          <?php echo $date=Date('Y-m-d');?> </p>
        </div>
 
        <div class="plan-boxes jsGridView">
          <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
              <div class="plan-box-header">
                <div class="more-wrapper">
            </div>
          </div>
          <div class="plan-box-content-header">
            <p class="box-content-header">Nintendo</p>
            <p class="box-content-subheader">14:00</p>
            <p class="box-content-subheader">Nation II, C01</p>
          </div>
        </div>

        </div>
        <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
            <div class="plan-box-header">
                <div class="more-wrapper">
                </div>
            </div>
            <div class="plan-box-content-header">
                <p class="box-content-header">Couch Gaming</p>
                <p class="box-content-subheader">14:00</p>
                <p class="box-content-subheader">Nation II, C02</p>
            </div>
            </div>
        </div>

        <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
            <div class="plan-box-header">
                <div class="more-wrapper">
                </div>
            </div>
            <div class="plan-box-content-header">
                <p class="box-content-header">Labo Infra</p>
                <p class="box-content-subheader">14:00</p>
                <p class="box-content-subheader">Nation I, A03</p>
            </div>
            </div>
        </div>

        <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
            <div class="plan-box-header">
            </div>
            <div class="plan-box-content-header">
                <p class="box-content-header">Labo IA</p>
                <p class="box-content-subheader">14:00</p>
                <p class="box-content-subheader">Nation I, A24</p>
            </div>
            </div>
        </div>

        <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
            <div class="plan-box-header">
                <div class="more-wrapper">
                </div>
            </div>
            <div class="plan-box-content-header">
                <p class="box-content-header">Cinéma</p>
                <p class="box-content-subheader">14:00</p>
                <p class="box-content-subheader">Nation II, C02</p>
            </div>
            </div>
        </div>

        <div class="plan-box-wrapper">
            <div class="plan-box" style="background-color: #e9e7fd;">
            <div class="plan-box-header">
                <div class="more-wrapper">
                </div>
            </div>
            <div class="plan-box-content-header">
                <p class="box-content-header">CS:GO</p>
                <p class="box-content-subheader">14:00</p>
                <p class="box-content-subheader">Nation II, C03</p>
            </div>
            </div>
        </div>

    </div>
  </div>

  <div class="asso-section">
    <div class="plans-section-header">
      <p>Mes associations</p>
    </div>
    <div class="messages">
      <div class="asso-box">
        <div class="asso-content">
          <div class="asso-header">
            <div class="name">Nintendo</div>
          </div>
          <p class="asso-line">14h00</p>
          <p class="asso-line">Nation II C01
          </p>
        </div>
      </div>
      <div class="asso-box">
        <div class="asso-content">
          <div class="asso-header">
            <div class="name">Couch Gaming</div>
          </div>
          <p class="asso-line">14h00</p>
          <p class="asso-line">Nation II C02</p>
        </div>
      </div>
      <div class="asso-box">
        <div class="asso-content">
          <div class="asso-header">
            <div class="name">Labo IA</div>
          </div>
          <p class="asso-line">15h30</p>
          <p class="asso-line">Nation I A24</p>
        </div>
      </div>
      <div class="asso-box">
        <div class="asso-content">
          <div class="asso-header">
            <div class="name">Cinema</div>
          </div>
          <p class="asso-line">16h00</p>
          <p class="asso-line">Nation I A07</p>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
</main>
</body>
  </html>