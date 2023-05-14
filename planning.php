<link href="assets/css/style.css" rel="stylesheet" />
<?php

session_start();
include 'includes/db.php';
include 'includes/userInfo.php';
include 'includes/header.php';

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
        <body>
        <?php include('includes/nav.php') ?>
        <main>
        <section class="container">
        <div class="app-content">
            <div class="plans-section">
                <div class="plans-section-header">
                    <p>Planning</p>
                    <p class="time"><?php echo $date=Date('Y-m-d');?></p>
                </div>

                <div class="plan-boxes jsGridView">
                <?php  
                $q = "SELECT reservation.idReserve, reservation.nbParticipants, user.entreprise, activite.nomActivite, horaires.heureDebut, horaires.heureFin, reservation.dateChoisi FROM reservation 
                    INNER JOIN user ON reservation.idUser = user.idUser
                    INNER JOIN activiteReserve ON activiteReserve.idReserve = reservation.idReserve
                    INNER JOIN activite ON activite.idActivite = activiteReserve.idActivite
                    INNER JOIN horaireReserve ON horaireReserve.idReserve = reservation.idReserve
                    INNER JOIN horaires ON horaires.idHoraires = horaireReserve.idHoraires";
                $res = $db->query($q);

                $currentDateTime = null;
                while ($row = $res->fetch()) {
                    $startDateTime = $row['dateChoisi'] . ' ' . $row['heureDebut'];
                    $endDateTime = $row['dateChoisi'] . ' ' . $row['heureFin'];
                    if ($currentDateTime !== $startDateTime) {
                        $currentDateTime = $startDateTime;
                        echo '<div class="plans-section-date">';
                        echo '<p class="plans-section-date-header">' . date('l d F Y H:i', strtotime($currentDateTime)) . '</p>';
                        echo '</div>';
                    }
                ?>
                    <div class="plan-box-wrapper">
                        <div class="plan-box" style="background-color: #e9e7fd;">
                            <div class="plan-box-header">
                                <div class="more-wrapper">
                                </div>
                            </div>
                            <div class="plan-box-content-header">
                                <h4 class="box-content-header"><?php echo $row['nomActivite']; ?></h4>
                                <p class="box-content-subheader"><?php echo date('H:i', strtotime($row['heureDebut'])) . " - " . date('H:i', strtotime($row['heureFin'])); ?></p>
                                <p class="box-content-subheader"><?php echo $row['nbParticipants'] . " participants"; ?></p>
                                <p class="box-content-subheader"><?php echo "Réservé par " . $row['entreprise']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
</main>
<?php //include('includes/footer.php'); ?>
</body>
</html>