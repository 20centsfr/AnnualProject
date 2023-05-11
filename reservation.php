<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/db.php');
include('includes/userInfo.php');
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
  $page="Reservation";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  
}
 

if(isset($_GET['Reserve'])){
  $idReserve = intval(htmlspecialchars($_GET['Reserve']));
    if(!is_int($idReserve))
      header('location:reservations.php');
}

  $select = $db->query('SELECT * FROM reservation WHERE idReserve = "' . $idReserve . '"');   
  $content = $select->fetch(PDO::FETCH_ASSOC);

  if($content == false)
    header('location:reservations.php');

?>

  <body>

  <style> 
      .section-a {
      margin: 2rem 0;
      }

      .section-a .container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 3rem;
      align-items: center;
      justify-content: center;
      }

      .section-a h1 {
      font-size: 4rem;
      color: var(--primary-color);
      }

      .section-a p {
      margin: 1rem 0;
      }

  </style>

    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
    <br><br><br><br>

    <section class="section-a">
      <div class="bg-holder bg-size" style="background-image:url(assets/img/illustration/2.png);background-position:right top;background-size:800px;"></div>

      <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="w-100 h-100 p-5 services-card-shadow rounded-4">
            <h4 class="text-center display-5 fw-semi-bold"><?php echo '<td>' . $content['dateChoisi'] . '</td>'; ?></h4><br><br>
            <p class="text-center fs-0 fs-md-1">Prix : <?php echo '<td>' . $content['prix'] . '</td>'; ?>€</p>

            <p class="text-center fs-0 fs-md-1"> Nombre de participants : <?php echo '<td>' . $content['nbParticipants'] . '</td>'; ?></p>

            <p class="text-center fs-0 fs-md-1"> Activités :</p>

            <?php 
            $activiteReq = $db->query("SELECT nomActivite FROM activiteReserve INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite WHERE idReserve='" . $content['idReserve'] . "'");
            echo '<td>';
            while ($activite = $activiteReq->fetch()) { ?>

                <div class=" text-center"><span><?php echo $activite['nomActivite'] . '</td>'; ?></span><i class="fa fa-check text-primary-gradient pt-1"></i></div>

            <?php } ?><br>            
            </div>
            </div>
        </div>
    </div> <br><br>

      </div>
    </section>
    </main>
    <footer> 
        <?php include('includes/footer.php') ?>
    </footer>
  </body>

</html>
