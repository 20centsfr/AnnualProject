<!DOCTYPE html>

<div class="app-container">
<?php
include 'includes/db.php';
include 'includes/header_admin.php';
include ('includes/gestionDroits.php');

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

?>

<html>
<link href="assets/css/style.css" rel="stylesheet" />
    <body>
    <main>
    <section class="container">
    <div class="app-content">
      <div class="plans-section">
        <div class="plans-section-header">
          <p>Activités en cours</p>
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
            <p class="box-content-header">Ping Pong</p>
            <p class="box-content-subheader">14:00</p>
            <p class="box-content-subheader">11ème</p>
            <p class="box-content-subheader">A11</p>
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
                <p class="box-content-subheader">A11</p>
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
                <p class="box-content-subheader">A11</p>
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
                <p class="box-content-subheader">A11</p>
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
                <p class="box-content-subheader">A11</p>
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
                <p class="box-content-subheader">A11</p>
            </div>
            </div>
            <br><br>
        </div>
        
    </div>
  </div>
</section>
</main>
</body>
  </html>