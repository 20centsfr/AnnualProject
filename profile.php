<?php
include "includes/header.php";
include "includes/userInfo.php";
include ('includes/connected.php');

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
            <a class="btn btn-primary" href="modifProfile.php" role="button">Modifier</a>
        </div>
      </section>

    
      <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1 class="text-center display-5 fw-semi-bold">Mes factures</h1>
                
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <br><br><br>
                        <form action="annuler.php" method="post">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'numeroFacture', 'Numéro de la facture');
                                theadFill($order, 'montant', 'Montant');
                                theadFill($order, 'dateFacture', 'Date');
                                theadFill($order, 'statusPaiement', 'Status');
                                theadFill($order, 'telechargement', 'Télécharger');
                                ?>
                            </tr>
                            </thead>

                            <?php
                            $req = $db->query('SELECT * FROM facture');
                            $req->execute() ;
                            while ($facture = $req->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $facture['numeroFacture'] . '</td>';
                                echo '<td>' . $facture['montant'] . '</td>';
                                echo '<td>' . $facture['dateFacture'] . '</td>';
                                echo '<td>' . $facture['statusPaiement'] . '</td>';
                                echo '<td> <button type="submit" value="'.$content['idActivite'].'" name="telecharger" class="btn btn-success">Télécharger</button></td>';
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
      </section>
    </main>
    <?php include('includes/footer.php') ?>
  </body>
</html>