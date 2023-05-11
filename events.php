<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/db.php');
include('includes/userInfo.php');

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
  $page="Event";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  
}

function theadFill($order, $value, $disp) {
  if ($order == $value)
      echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
  else
      echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}

?>

  <body>
    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
    <br><br>
    <?php include('includes/message.php') ?>

    <section id="customers">
        <div class="container">
          <h1 class="text-center display-5 fw-semi-bold">Events spéciaux</h1>
          <p class="text-center fs-0 fs-md-1"> Ces événements permettent aux participants de se connaître mieux, d'apprendre à travailler ensemble de manière efficace et de développer des compétences clés telles que la communication, la confiance, la prise de décision, la résolution de problèmes, la gestion du temps, etc. <br>Cherchez parmi des dizaines d’activités et faites votre demande de devis en ligne. Together&Stronger propose des activités insolites, originales ainsi que les grands classiques de l’événement d’entreprise.</p>
          <br><br><br>

          <style>
            .grid-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                grid-gap: 20px;
              }

              .grid-container .col-md-6 {
                height: 400px;
                min-height: 400px;
                max-height: 500px;
                width: 100%;
              }
          </style>

          <div class="grid-container">
            <?php 
              $select = $db->query("SELECT * FROM event");
              while ($content = $select->fetch()) {
                  $images = glob('assets/img/icons/*.png');
                  $random_image = $images[array_rand($images)];

                  $event_date = strtotime($content['dateEvent']);
                  $current_date = time();
                  $idEvent = $content['idEvent'];
                  if ($event_date >= $current_date) {
            ?>
                    <div class="col-md-6 col-lg-3 text-center">
                    <form action="participer.php" method="POST">
                      <img src="<?php echo $random_image; ?>" alt="Dashboard" style="width:95px;" />
                      <h2 class="mt-3 lh-base"><?php echo $content['nomEvent']; ?></h2>
                      <p class="fs-0">Nombre de places : <?php echo $content['nbPlacesEvent']; ?></p>
                      <p class="fs-0">Points à gagner : <?php echo $content['nbPointsEvent']; ?></p>
                      <p class="fs-0">Date : <?php echo $content['dateEvent']; ?></p>
                      <p class="fs-0">Lieu : <?php echo $content['lieuEvent']; ?></p>
                      <input type="hidden" name="idUser" value="<?php echo $idUser; ?>" >
                      <input type="hidden" name="idEvent" value="<?php echo $idEvent; ?>" >
                      <?php
                      if(isset($_SESSION['email'])){
                        echo '<button type="submit" value="'.$content['idEvent'].'" name="Event" class="btn btn-success">Participer</button>';
                      }
                      ?>
                      </form>
                    </div>
            <?php } } ?>
          </div>

          </div>
        </section>

        
        <section class="container">
              <div class="row col-12">
                  <br><br><br><br><br><br>
                  <h1>Mes events</h1><br>
                  <div class="overflow-auto">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <form action="quitterEvent.php" method="POST">
                              <thead>
                                  <tr>
                                      <?php
                                      theadFill($order, 'nomEvent', 'Nom de l\'event');
                                      theadFill($order, 'dateEvent', 'Date');
                                      theadFill($order, 'lieuEvent', 'Lieu');
                                      theadFill($order, 'Quitter', 'Quitter');
                                      theadFill($order, 'presence', 'Signaler presence');
                                      ?>
                                  </tr>
                              </thead>
                              <?php
                              $currentDate = date("Y-m-d");
                              $req = $db->query("SELECT * FROM participe, event WHERE idUser = $idUser AND participe.idEvent = event.idEvent AND dateEvent >= '$currentDate'");

                              $req->execute();
                              while ($event = $req->fetch()) {
                                  echo '<tr>';
                                  echo '<td>' . $event['nomEvent'] . '</td>';
                                  echo '<td>' . $event['dateEvent'] . '</td>';
                                  echo '<td>' . $event['lieuEvent'] . '</td>';
                                  echo '<td>' .'<input type="hidden" name="idUser" value="'.$idUser.'" >'.' <button type="submit"   class="btn btn-danger"  value="'.$event['idEvent'].'" name="idEvent" class="btn btn-danger">Quitter</button></form></td>';

                                  if ($currentDate == $event["dateEvent"]) {
                                      echo "<form action='attendEvent.php' method='POST'>";
                                      echo "<input type='hidden' name='idEvent' value='" . $event["idEvent"] . "'>";
                                      echo "<input type='submit' name='attend' value='Signaler ma presence'>";
                                      echo "</form>";
                                  }
                                  echo '</tr>';
                              }
                              ?>
                          
                          </tbody>
                      </form>
                      </table>
              </div>
      </section>
      <footer> 
        <?php include('includes/footer.php') ?>
      </footer>
    </main>
  </body>
</html>