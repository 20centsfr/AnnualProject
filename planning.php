<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php

session_start();
include 'includes/db.php';
include 'includes/header.php';
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
<div class="app-container">
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
                <?php  
                    $q = "SELECT activite.nomActivite, reservation.dateChoisi, horaires.heureDebut, salle.numSalle
                            FROM reservation 
                            INNER JOIN horaires ON reservation.idHoraires = horaires.idHoraires
                            
                          
                            INNER JOIN activitereserve ON reservation.idReserve = activiteactivite.idReserve
                            INNER JOIN activite ON activitereserve.idActivite = activite.idActivite";
    
                            //INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite
                            //INNER JOIN salle ON reservation.idSalle = salle.idSalle
                    $res = $db->query($q);
                    while ($row = $res->fetch()) {
                ?>
                <div class="plan-box-wrapper">
                    <div class="plan-box" style="background-color: #e9e7fd;">
                        <div class="plan-box-header">
                            <div class="more-wrapper">
                            </div>
                        </div>
                        <div class="plan-box-content-header">
                            <h4 class="box-content-header"><?php echo $row['nomActivite']; ?></h4>
                            <p class="box-content-subheader"><?php echo $row['dateChoisi']; ?></p>
                            <p class="box-content-subheader"><?php echo $row['heureDebut']; ?></p>
                            <!--<p class="box-content-subheader"><?php //echo $row['numSalle']; ?></p>-->
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
      </div>
  </section>
</main>
</body>
  </html>