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
                <h1>Mes devis</h1><br>
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


        <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes reservations</h1><br>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form action="annulerReserve.php" method="POST">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'date', 'Date');
                                theadFill($order, 'prix', 'Prix');
                                theadFill($order, 'Nombre de participants', 'Nombre de participants');
                                //theadFill($order, 'Participants', 'Participants');
                                //theadFill($order, 'activite', 'Activités');
                                theadFill($order, 'Annuler', 'Annuler');
                                //theadFill($order, 'Payer', 'Payer');
                                ?>
                            </tr>
                            </thead>

                            <?php

                                $req = $db->query("SELECT * FROM reservation WHERE idUser='" . $idUser . "'");
                                while ($reserve = $req->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $reserve['dateChoisi'] . '</td>';
                                    echo '<td>' . $reserve['prix'] . '</td>';
                                    echo '<td>' . $reserve['nbParticipants'] . '</td>';

                                    /*echo '<td>' . $reserve['nbParticipants'] . '</td>';
                                    
                                    $participantsReq = $db->query("SELECT * FROM participants WHERE idReserve='" . $reserve['idReserve'] . "'");
                                    if ($participantsReq->rowCount() > 0) {
                                        while ($participant = $participantsReq->fetch()) {
                                            echo $participant['nom'] . ' ' . $participant['prenom'] . ' (' . $participant['email'] . ')<br>';
                                        }
                                    }
                                    
                                    $activiteReq = $db->query("SELECT nomActivite FROM activiteReserve INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite WHERE idReserve='" . $reserve['idReserve'] . "'");
                                    echo '<td>';
                                    while ($activite = $activiteReq->fetch()) {
                                        echo $activite['nomActivite'] . '<br>';
                                        $idActivite = $activite['idActivite'];
                                    }
                                    */


                                    echo '<td>';
                                    echo '<form action="annulerReserve.php" method="post" style="display: inline-block;">';
                                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                                    echo '<input type="hidden" name="idUser" value="'.$reserve['prix'].'" >';
                                    echo '<button type="submit" class="btn btn-danger" name="idReserve" value="'.$reserve['idReserve'].'">Annuler</button>';
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

        <section class="container">
        <div class="row">
        <h1>Mes reservations</h1><br>
        <?php $req = $db->query("SELECT * FROM reservation WHERE idUser='" . $idUser . "'");
        while ($reserve = $req->fetch()) {
            ?>
            <div class="col-md-4">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="bg-light rounded">
                            <div class="border-bottom p-4 mb-4">
                                <h4 class="text-primary-gradient mb-1">Reservation</h4>
                                <span><?php echo '<td>' . $reserve['dateChoisi'] . '</td>'; ?></span>
                            </div>
                            <div class="p-4 pt-0">
                                <h1 class="mb-3">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;">€</small><?php echo '<td>' . $reserve['prix'] . '</td>'; ?>
                                </h1>
                                <div class="d-flex justify-content-between mb-3"><span>Nombre de participants : <?php echo '<td>' . $reserve['nbParticipants'] . '</td>'; ?></span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                <form method="GET" action="reservation.php">
                                    <input type="hidden" name="Reserve" value="<?php echo $reserve['idReserve']; ?>" >
                                    <button type="submit" class="btn btn-success">Plus d'information</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php } ?>
        </section>

        <?php include('includes/footer.php') ?>
    </main>
  </body>
</html>