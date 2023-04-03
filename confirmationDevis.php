<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    
<?php 
include('includes/header.php');
include('includes/db.php');

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
  $page="Devis2";

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

  <body>
    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
        <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: #f9f9f9;
            }

            #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
            }

            #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
            }

            .bg-glass {
            background-color: #e7eaef;
            backdrop-filter: saturate(200%) blur(25px);
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: #8313c4">
                FAIRE UN <br />
                <span style="color: #400861">DEVIS</span>
                </h1>
            </div>

            <?php 
            $q = $db->query("SELECT * FROM devis WHERE idUser=(SELECT idUser FROM user WHERE email='" . $_SESSION['email'] . "')");

            $req->execute() ;
            while ($devis = $req->fetch()) {
            
            ?>
            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">
                    <form action="suppDevis.php" method="POST">
                        <div class="form-outline mb-4">
                            <h2 class="mt-3 lh-base">Devis</h2>
                            <h4 class="mt-3 lh-base">Nombre de participants</h4>
                            <p class="fs-0"><?php echo $devis['nbParticipants'] ?></p>
                        </div>
                        <div class="form-outline mb-4">
                            <h4 class="mt-3 lh-base">Prix</h4>
                            <p class="fs-0"><?php echo $devis['prix'] }?></p>
                        </div>
                        <!-- ACTIVITES CHOISIES -->
                        <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <a href="devis.php" style="color: #8313c4" class="link-dark"><h5>Mes devis</h5></a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-4">Annuler</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>

  </body>

</html>