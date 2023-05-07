<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/db.php');
include('includes/userInfo.php');
session_start();


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
  $page="Activite";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  
}


 

if(isset($_GET['Activite'])){
  $idActivite = intval(htmlspecialchars($_GET['Activite']));
    if(!is_int($idActivite))
      header('location:activites.php');
}

  $select = $db->query('SELECT * FROM activite WHERE idActivite = "' . $idActivite . '"');   
  $content = $select->fetch(PDO::FETCH_ASSOC);

  if($content == false)
    header('location:activites.php');

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
          <div class="grid-container">
            <h1 class="mt-3 lh-base"><?php echo $content['nomActivite']; ?></h1>
                <p class="fs-0">Nombre de places : <?php echo $content['nbPlacesActivite']; ?></p>
                <p class="fs-0">Duree : <?php echo $content['dureeActivite']; ?> minutes</p>
                <p class="fs-0">Lieu : <?php echo $content['localActivite']; ?></p>
                <p class="fs-0"><?php echo $content['tarifActivite']; ?> € </p>
                <p class="fs-0"><?php echo $content['descriptionActivite']; ?></p>
          </div>
        </div>
      </div>
    </section>


    </main>
    <footer> 
        <?php include('includes/footer.php') ?>
      </footer>
  </body>

</html>
