<?php
include "includes/header.php";
include "includes/userInfo.php";
include ('includes/connected.php');


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
        $page="Profil";

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

        <h1 class="text-center display-5 fw-semi-bold">Mon compte</h1>


        <section id="product">
            <div class="container">
          <div class="row mb-4">
            <div class="col-md-6 h-100 text-center text-md-start p-0 p-md-5 pb-3">
              <h2 class="mt-3">Mes informations personnelles</h2>
            </div>
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/2.png" alt="Dashboard" style="width:95px;" />
                <h3 class="mt-3 lh-base">Nom</h3>
                <?php 
                echo '<p class="mb-0">' . $userInfo['prenom'] . '</p>';
                echo '<p class="mb-0">' . $userInfo['nom'] . '</p>';
                ?>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/2.png" alt="Comment" style="width:95px;" />
                <h3 class="mt-3 lh-base">Entreprise</h3>
                <?php 
                echo '<p class="mb-0">' . $userInfo['entreprise'] . '</p>';
                ?>
                </div>
            </div>
            <div class="col-md-6">
              <div class="w-100 h-100 p-5 services-card-shadow rounded-4"><img src="assets/img/icons/2.png" alt="Tailored" style="width:95px;" />
                <h3 class="mt-3 lh-base">Email</h3>
                <?php 
                echo '<p class="mb-0">' . $_SESSION['email'] . '</p>';
                ?>              
                </div>
            </div>
          </div>
        </div> <br><br>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="modifProfile.php" role="button">Modifier mes informations</a>
        </div>
        <br><br>
        <div class="d-flex justify-content-center">
            <!--<a class="btn btn-primary" href="note/index.php" role="button">Supprimer mon compte</a>-->
            <?php 
            echo '<form action="suppCompte.php" method="POST">';
            //echo '<input type="hidden" name="idUser" value="' . $idUser . '" >';
            echo '<td> <button type="submit" value="'.$idUser.'" name="Supprimer" class="btn btn-danger">Supprimer mon compte</button></td>'; 
            //echo '<button type="submit" class="btn btn-primary btn-block mb-4">Continuer</button>';
            echo '</form>';
            ?>
        </div>
      </section>


      <div class="container">
        <div class="row">
          <div class="col-md-4 mx-auto">
            <div class="w-100 h-100 p-5 services-card-shadow rounded-4">
            <h3 class="text-center display-5 fw-semi-bold">Mes points T&S</h3><br><br>
            <p class="text-center fs-0 fs-md-1"> Nombre de points TS :</p>
            <h3 class="text-center display-5 fw-semi-bold"><?php 
            echo '<p class="mb-0">' . $userInfo['nbPoints'] . '</p>';
            ?> </h3><br><br>
            <?php
            if ($userInfo['nbPoints'] >= 50) {
                echo '<a class="btn btn-primary" href="fidelites.php" role="button">Découvrez nos offres spéciales</a>';
            } else {
              echo '<a class="btn btn-primary" href="#" role="button">Gagnez plus de points pour débloquer nos offres spéciales !</a>';
            }          
            ?><br><br>            
            </div>
          </div>
        </div>
      </div>

    
      <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1 class="text-center display-5 fw-semi-bold">Mes factures</h1>
                
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <br><br><br>
                        <form action="facture.php" method="post">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'date', 'Date de paiement');
                                theadFill($order, 'montant', 'Montant');
                                theadFill($order, 'telechargement', 'Télécharger');
                                ?>
                            </tr>
                            </thead>

                            <?php
                            $q = 'SELECT * FROM paiement WHERE email = :email';
                            $req = $db->prepare($q);
                            $req->execute([
                              'email' => $userInfo['email']
                            ]);
                            
                            while ($paiement = $req->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $paiement['date'] . '</td>';
                                echo '<td>' . $paiement['montant'] . '</td>';
                                echo '<td><form action="facture.php" method="post"><input type="hidden" name="idPaiement" value="'.$paiement['idPaiement'].'"><button type="submit" name="telecharger" class="btn btn-success">Télécharger</button></form></td>';
                                echo '</tr>';
                            }
                            ?>
                        </form>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
      </section>

      <section class="container">
        <div class="grid-container">
        <div class="row">
          <h1 class="text-center display-5 fw-semi-bold">Mon historique de reservations</h1><br><br><br>
          <?php $req = $db->query("SELECT * FROM reservation WHERE idUser='" . $idUser . "'");
          while ($reserve = $req->fetch()) {
              $reserve_date = strtotime($reserve['dateChoisi']);
              $current_date = time();
              $idReserve = $reserve['idReserve'];
              if ($reserve_date >= $current_date) {
          ?>
        <div class="col-md-4">
          <div class="card mb-4 services-card-shadow rounded-4">
            <div class="card-body">
              <h4 class="text-center display-5 fw-semi-bold"><?php echo '<td>' . $reserve['dateChoisi'] . '</td>'; ?></h4><br><br>
              <p class="text-center fs-0 fs-md-1">Prix : <?php echo '<td>' . $reserve['prix'] . '</td>'; ?>€</p>
              <p class="text-center fs-0 fs-md-1"> Nombre de participants : <?php echo '<td>' . $reserve['nbParticipants'] . '</td>'; ?></p>
              <p class="text-center fs-0 fs-md-1"> Activités :</p>
              <?php 
              $activiteReq = $db->query("SELECT nomActivite FROM activiteReserve INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite WHERE idReserve='" . $reserve['idReserve'] . "'");
              echo '<td>';
              while ($activite = $activiteReq->fetch()) { ?>
                <div class=" text-center"><span><?php echo $activite['nomActivite'] . '</td>'; ?></span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
              <?php } ?> 
              <br>           
              </div>
              </div>
          </div> <?php } } ?>
      </div>
    </div>
    </section>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>