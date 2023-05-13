<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 

include('includes/header.php');
include('includes/db.php');
include('banni.php');
session_start();

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
  $page="Accueil";

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
      
      <section class="py-7 py-lg-10" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/illustration/2.png);background-position:left top;background-size:contain;"></div>
        <div class="bg-holder d-none d-xxl-block hero-bg" style="background-image:url(assets/img/illustration/1.png);background-position:right top;background-size:contain;"></div>
        <div class="container">
          <div class="row align-items-center h-100 justify-content-center justify-content-lg-start">
            <div class="col-md-9 col-xxl-5 text-md-start text-center py-6 pt-8">
              <h1 class="fs-4 fs-md-5 fs-xxl-4">TOGETHER&STRONGER</h1>
              <p class="fs-1" >TEAM BUILDING : Renforcez vos liens à travers des activités originales. </p>

              <?php 
              if(!isset($_SESSION['email'])){
                echo '<div class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-start mt-5" ><a class="btn btn-sm btn-primary me-1" href="inscription.php" role="button">Inscrivez-vous</a></div>';
              } ?>

              
            </div>
          </div>
        </div>
      </section>

      <section id="product">
        <div class="container">
          <div class="row mb-4">
            <div class="col-md-6 h-100 text-center text-md-start p-0 p-md-5 pb-3">
              <h2 class="mt-3">À votre image</h2>
              <p class="mb-0">Des activités personnalisées intégrant les valeurs de votre entreprise.</p>
            </div>
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/2.png" alt="Dashboard" style="width:95px;" />
                <h3 class="mt-3 lh-base">Pour tous</h3>
                <p class="mb-0">Un moment fun et inoubliable, pour tous les âges et tous les goûts !</p>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/2.png" alt="Comment" style="width:95px;" />
                <h3 class="mt-3 lh-base">Où vous voulez</h3>
                <p class="mb-0">Organisation d’événements jusqu’à 2000 personnes, à domicile ou en extérieur.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/3.png" alt="Tailored" style="width:95px;" />
                <h3 class="mt-3 lh-base">Flexibilité et sérénité</h3>
                <p class="mb-0">Réservation 100% modifiable, respect des règles sanitaires en vigueur.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5">
        <div class="container" id="auto">
          <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
              <h6 class="fs-3 fw-normal mt-6">Pourquoi travailler avec nous ?</h6>
              <ul class="list-unstyled py-3">
                <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span>Nous sommes spécialisés dans la création d'expériences amusantes et pratiques de Corporate Team Building à Paris. Stimulez le moral de vos troupes, améliorez votre culture d'entreprise et approfondissez les liens humains grâce à des cours alléchants, des histoires incroyables et des activités pratiques. Que vous soyez un groupe de 8 ou 800 personnes, nous avons une expérience de restauration et de boisson pour votre équipe</li>
              </ul>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 text-start">
              <h3 class="fs-2 fw-normal">Des animateurs expérimentés</h3>
              <ul class="list-unstyled py-3">
              <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span>Notre équipe a organisé plus de 1 500 événements</li>
              <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span>La moyenne des commentaires sur les événements et les animateurs est de 9,7/10 ou plus.</li>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5">
        <div class="container" id="auto">
          <div class="row align-items-center">
            <div class="col-md-6 text-md-start">
              <h4 class="fs-2 fw-normal">Responsabilité sociale de l'entreprise</h4>
              <ul class="list-unstyled py-3">
                <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span>  Choix d'une gamme complète d'événements caritatifs</li>
                <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span> 3 % de chaque événement est reversé à une association caritative</li>
              </ul>
            </div>
            <div class="col-md-6 mt-4 mt-md-0 text-start">
              <h4 class="fs-2 fw-normal">Garantie de remboursement</h4>
              <ul class="list-unstyled py-3">
                <li class="mb-3 text-900"><span class="far fa-check-circle text-700 me-2"></span>Nous savons que choisir le fournisseur idéal est un risque. Nous sommes tellement convaincus que votre événement sera un succès que nous vous offrons volontiers une garantie de remboursement. 
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      
      <section id="pricing">
        <div class="container">
          <div class="row flex-center">
            <div class="col-md-6 text-center text-md-start">
              <h4 class="fw-normal fs-3">Nos événements <br/>collaboratifs</h4>
              <p class="fs-0 pe-xl-8" >
              Le team building est aussi un moment pour laisser place à son imagination et s’exprimer.
              Nous proposons des jeux qui favorisent l’improvisation, le lâcher prise et qui permettront à certains de s’exprimer sous une autre forme, comme de découvrir ses collègues sous un nouveau jour.
              Fous rires garantis ! Améliorez la connaissance entre vos équipes avec :
                   <ul>
                    <li>Nos jeux d’improvisation</li>
                    <li>La box immersive</li>
                  </ul>

              </p>
              <div class="d-flex justify-content-space-between align-item-center my-3 mt-2">
              </div>
              <button onclick="location.href='devis.php'" class="btn btn-sm btn-primary btn-bg-purple my-4 me-1" type="button">Demander un devis</button>
            </div>
            <div class="col-md-6 mb-4"><img class="w-100" src="assets/img/illustration/4.png" alt="..." /></div>
          </div>
        </div>
      </section>

      <section>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6 mb-4"><img class="w-100" src="assets/img/illustration/5.png" alt="..." /></div>
            <div class="col-md-6 text-center text-md-start">
              <h4 class="fs-3 fw-normal">Nos événements <br />créatifs</h4>
              <p class="fs-0 pe-xl-7" >
               Nous vous proposons des événements sur-mesure, spécifiquement conçus pour développer la créativité de vos équipes.
              Grâce à l’art, adoptez un autre point de vue et mettez en lumière les talents créatifs de vos collaborateurs !
              La créativité peut s’exprimer sous différentes formes, différentes techniques, expérimentez-les à travers nos ateliers créatifs :
              <ul>
                <li>Art & Cocktail</li>
                <li>Customisation de produits</li>
              </ul>
              </p>
              <div class="d-flex justify-content-center align-item-center my-3 mt-2"> </div>
              <button onclick="location.href='contact.php'" class="btn btn-sm btn-primary btn-bg-purple my-4 me-1" type="button">Contactez-nous</button>

            </div>
          </div>
        </div>
      </section>

      <section>
      <?php include('carte.php') ?>
      </section>

      <section class="container">
      <div class="grid-container">
        <div class="row">
            <h1 class="text-center display-5 fw-semi-bold">Avis de nos clients</h1><br>
            <?php 
            if(isset($_SESSION['email'])){
              echo '<div class="d-flex justify-content-center">
              <a class="btn btn-primary" href="avis.php" role="button">Donner un avis</a>
              </div>';
            } ?>
            <br>
            <?php $req = $db->query("SELECT * FROM avis");
            while ($avis = $req->fetch()) {
                $idAvis = $avis['idAvis'];
            ?>
            <div class="col-md-4">
            <div class="card mb-4 services-card-shadow rounded-4">
                <div class="card-body">
                <h4 class="text-center display-5 fw-semi-bold"><?php echo '<td>' . $avis['entreprise'] . '</td>'; ?></h4><br>

                <span><?php echo $avis['avis'] . '</td>'; ?></span><i class="fa fa-check text-primary-gradient pt-1"></i></div>

                <br>           
                </div>
                </div>
            </div> <?php } ?>
        </div></div> 
      </section>
      
      <?php include('includes/footer.php') ?>
    </main>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>
    <script>
      window.OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
        OneSignal.init({
          appId: "520b99ae-d13d-4591-b03d-07dc5d11d02b",
        });
      });
    </script>
    
  </body>
</html>