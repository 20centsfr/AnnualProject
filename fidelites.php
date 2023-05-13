<?php
include "includes/header.php";
include "includes/userInfo.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_GET['order']))
        $order = $_GET['order'];
    else
        $order = "idFacture";
    $select = $db->query("SELECT * FROM facture ORDER by $order");

    function theadFill($order, $value, $disp) {
        if ($order == $value)
            echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
        else
            echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
    }

    function getIp(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
        if(isset($_SESSION['email'])){

        $ip=getIp();
        $date=Date('Y-m-d');
        $heure=Date("H:i:s");
        $page="Fidelites";

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
    <main>
    <?php include('includes/nav.php') ?>

    <section class="py-7 py-lg-10" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/illustration/2.png);background-position:left top;background-size:1000px;"></div>
        <div class="bg-holder bg-size" style="background-image:url(assets/img/illustration/2.png);background-position:right top;background-size:800px;"></div>

        <div class="container">
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4">
              <h3 class="text-center display-5 fw-semi-bold">Mes points T&S</h3><br><br>
              <p class="text-center fs-0 fs-md-1"> Nombre de points TS :</p>
              <h3 class="text-center display-5 fw-semi-bold"><?php 
              echo '<p class="mb-0">' . $userInfo['nbPoints'] . '</p>';
              ?> </h3><br><br>            
              </div>
            </div>
          </div>
        </div>

    
      <section id="customers">
        <div class="container">
          <h1 class="text-center display-5 fw-semi-bold">Offres pour nos clients fidèles </h1>
          <p class="text-center fs-0 fs-md-1"> description bblablabala</p>
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
          $select = $db->query("SELECT * FROM fidelite");
          while ($content = $select->fetch()) {
            $images = glob('assets/img/icons/*.png');
            $random_image = $images[array_rand($images)];
          ?>
            <div class="col-md-6 col-lg-3 text-center">
              <img src="<?php echo $random_image; ?>" alt="Dashboard" style="width:95px;" />
              <h2 class="mt-3 lh-base"><?php echo $content['nomFidelite']; ?></h2>
              <h3 class="fs-0"><?php echo $content['description']; ?></h3>
              <p class="fs-0">Points nécessaires : <?php echo $content['points']; ?></p>
              <p class="fs-0">Offre valable jusqu'à <?php echo $content['dateFin']; ?></p>
              <?php if ($userInfo['nbPoints'] >= $content['points']) { ?>
                <h3><?php echo $content['code']; ?></h3>
              <?php } else { ?>
                <a class="btn btn-primary" href="#" role="button">Pas assez de points</a>
              <?php } ?>
            </div>
          <?php } ?>
          </div>

          </div>
      </section>
    </section>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>