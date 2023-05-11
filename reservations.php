<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 

include('includes/header.php');
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
  $page="Reservations";

  $q = "INSERT INTO logs (page, date, heure, ip) VALUES (:page, :date, :heure, :ip)";
  $req = $db->prepare($q);
  $reponse = $req->execute([
      'page'=>$page,
      'date' => $date,
      'heure'=>$heure,
      'ip' => $ip
  ]);
  
}

if (isset($_GET['order'])) 
    $order = $_GET['order'];
else 
    $order = "idActivite";

$select = $db->query("SELECT * FROM activite ORDER by $order");

function theadFill($order, $value, $disp) {
    if ($order == $value)
        echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
    else
        echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}


$_SESSION['prix'] = $price;


?>

  <body>
    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
    <br><br><br><br>
    <section class="container">
        <?php include('includes/message.php') ?>
        <br><br>
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes devis</h1>
                <div class="d-flex align-left">
                    <a class="btn btn-primary" href="devis.php" role="button">Faire un devis</a>
                </div></div><br><br>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="annulerDevis.php" method="POST">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'date', 'Date de devis');
                                theadFill($order, 'prix', 'Prix');
                                theadFill($order, 'prix', 'Nombre de participants');
                                theadFill($order, 'activite', 'Activités');
                                theadFill($order, 'Supprimer', 'Supprimer');
                                theadFill($order, 'Réserver', 'Réserver');
                                ?>
                            </tr>
                            </thead>

                            <?php

                                $req = $db->query("SELECT * FROM devis WHERE idUser='" . $idUser . "' AND DATEDIFF(NOW(), date) < 14");
                                while ($devis = $req->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $devis['date'] . '</td>';
                                    echo '<td>' . $devis['prix'] . ' €</td>';
                                    echo '<td>' . $devis['nbParticipants'] . '</td>';

                                    $activiteReq = $db->query("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis='" . $devis['idDevis'] . "'");
                                    echo '<td>';
                                    while ($activite = $activiteReq->fetch()) {
                                        echo $activite['nomActivite'] . '<br>';
                                        $idActivite = $activite['idActivite'];
                                        echo '<input type="hidden" name="idActivite[]" value="'.$activite['idActivite'].'" >';
                                    }

                                    echo '<td>';
                                    echo '<form action="annulerDevis.php" method="post" style="display: inline-block;">';
                                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                                    echo '<button type="submit" class="btn btn-danger" name="idDevis" value="'.$devis['idDevis'].'">Supprimer</button>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<form action="reserverDevis.php" method="POST" 
                                    style="display: inline-block;">';
                                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                                    echo '<button type="submit" class="btn btn-success" name="idDevis" value="'.$devis['idDevis'].'">Réserver</button>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                        </tbody>
                    </form>
                </table>
            </div>
    </section>

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
    <div class="container">
        <h1>Mes reservations</h1><br><br>
        <?php $req = $db->query("SELECT * FROM reservation WHERE idUser='" . $idUser . "'");
        while ($reserve = $req->fetch()) {
            $reserve_date = strtotime($reserve['dateChoisi']);
            $current_date = time();
            $idReserve = $reserve['idReserve'];
            if ($reserve_date >= $current_date) {
        ?>
        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="w-100 h-100 p-5 services-card-shadow rounded-4">
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
            <form method="GET" action="reservation.php">
                <input type="hidden" name="Reserve" value="<?php echo $reserve['idReserve']; ?>" >
                <button type="submit" class="btn btn-primary">Plus d'information</button>
            </form><br>            
            </div>
            </div>
        </div> <?php } } ?>
    </div></div> <br><br>

    <?php include('includes/footer.php') ?>
    </main>
  </body>
</html>