<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/db.php');
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
  $page="Activites";

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

    <br><br><br><br>

      <section id="customers">
        <div class="container">
          <h1 class="text-center display-5 fw-semi-bold">Nos activités</h1><br><br>
          <p class="text-center fs-0 fs-md-1"> Vous êtes à la recherche d’une activité pour votre prochain événement d’entreprise ? Nous vous proposons les meilleures activités pour entreprises à Paris. Team Building, séminaire, soirée d’entreprise ou afterwork : vous trouverez une activité quelle que soit votre recherche. <br>Cherchez parmi des dizaines d’activités et faites votre demande de devis en ligne. Together&Stronger propose des activités insolites, originales ainsi que les grands classiques de l’événement d’entreprise. blabla</p>
          <br><br><br>
          <div class="row height d-flex justify-content-center align-items-center">
            <div class="form">
              <i class="fa fa-search"></i>
              <input type="text" class="form-control form-input" placeholder="Chercher une activité" id="searchActivite" oninput="search()">
              <div class="list-group list-group-item-action" id="content">
              </div>
            </div> 
          </div>
          <br><br><br>

          <div class="grid-container">
            <?php 
              $select = $db->query("SELECT * FROM activite");
              while ($content = $select->fetch()) {
                  $images = glob('assets/img/icons/*.png');
			            $random_image = $images[array_rand($images)];
            ?>
              <div class="col-md-6 col-lg-3 text-center">
                <img src="<?php echo $random_image; ?>" alt="Dashboard" style="width:95px;" />
                <h2 class="mt-3 lh-base"><?php echo $content['nomActivite']; ?></h2>
                <p class="fs-0">Nombre de places : <?php echo $content['nbPlacesActivite']; ?></p>
                <p class="fs-0">Duree : <?php echo $content['dureeActivite']; ?> minutes</p>
                <p class="fs-0">Lieu : <?php echo $content['localActivite']; ?></p>
                <p class="fs-0"><?php echo $content['tarifActivite']; ?> € / personne</p>
                <form method="GET" action="activite.php">
                  <input type="hidden" name="Activite" value="<?php echo $content['idActivite']; ?>" >
                  <button type="submit" class="btn btn-success">Plus d'info</button>
                </form>
              </div>
            <?php } ?>
          </div>

          </div>
        </section>

      <section class="bg-200" id="cta">
          <div class="row align-items-center">
            <div class="col-lg-6 text-center">
              <h2 class="fw-bold text-black">Intéressé ?</h2>
            </div>
            <div class="col-lg-6 h-100">
              <div class="input-group"> 
              <?php 
              if(isset($_SESSION['email'])){
                echo '<a class="btn btn-primary" href="devis.php" role="button">Faire un devis</a>';
              } else {
                echo '<a class="btn btn-primary" href="connexion.php" role="button">Connexion</a>';
              }               
              ?>
              </div>
          </div>
        </div>
      </section>  

    </main>
    <footer> 
      <?php include('includes/footer.php') ?>
    </footer>
  </body>

  <script>
        async function search(){
          const input = document.getElementById('searchActivite').value;
          if(input.length > 2){
            const res = await fetch(`searchActivite.php?value=${input}`);
            const str = await res.text();
            const container = document.getElementById('content');
            container.innerHTML = str;
          } else {
            const container = document.getElementById('content');
            container.innerHTML = null;
          }
        }
      </script>

</html>