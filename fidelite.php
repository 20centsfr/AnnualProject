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
  $page="Fidelite";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  
}

if (isset($_SESSION['idUser'])) {
  $idUser = $_SESSION['idUser'];
} else {
  echo "Session variable idUser is not set";
}

if(isset($_GET['Fidelite'])){
  $idFidelite = intval(htmlspecialchars($_GET['fidelite']));
    if(!is_int($idFidelite))
      header('location:fidelites.php');
}

  $select = $db->query('SELECT * FROM fidelite WHERE idFidelite = "' . $idFidelite . '"');   
  $content = $select->fetch(PDO::FETCH_ASSOC);

  if($content == false)
    header('location:fidelites.php');

?>

  <body>
    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
    <br><br><br><br>

    <section class="section-a">
    <div class="bg-holder bg-size" style="background-image:url(assets/img/illustration/2.png);background-position:right top;background-size:800px;"></div>
        <div class="container">
          <div class="grid-container">
            <h1 class="mt-3 lh-base"><?php echo $content['nomFidelite']; ?></h1>
                <p class="fs-0">Description : <?php echo $content['description']; ?></p>
                <p class="fs-0">Points necessaires : <?php echo $content['points']; ?></p>
                <p class="fs-0">Ofree valable jusqu'à : <?php echo $content['dateFin']; ?></p>
                <?php
                if(isset($_SESSION['email'])){
                  echo '<button type="submit" value="'.$content['idFidelite'].'" name="Fidelite" class="btn btn-success">Profiter de cette offre</button>';
                }
                ?>
          </div>
          </div>
          </div>
        </section>
    

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

    </main>
    <footer> 
        <?php include('includes/footer.php') ?>
      </footer>
  </body>

</html>