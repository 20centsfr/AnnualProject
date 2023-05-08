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
                                theadFill($order, 'Participants', 'Participants');
                                theadFill($order, 'activite', 'Activités');
                                theadFill($order, 'Annuler', 'Annuler');
                                theadFill($order, 'Payer', 'Payer');
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

                                    echo '<td>' . $reserve['nbParticipants'] . '</td>';
                                    
                                    /*$participantsReq = $db->query("SELECT * FROM participants WHERE idReserve='" . $reserve['idReserve'] . "'");
                                    if ($participantsReq->rowCount() > 0) {
                                        while ($participant = $participantsReq->fetch()) {
                                            echo $participant['nom'] . ' ' . $participant['prenom'] . '' . $participant['email'] . '<br>';
                                        }
                                    }*/
                             
                                    $activiteReq = $db->query("SELECT nomActivite FROM activiteReserve INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite WHERE idReserve='" . $reserve['idReserve'] . "'");
                                    echo '<td>';
                                    while ($activite = $activiteReq->fetch()) {
                                        echo $activite['nomActivite'] . '<br>';
                                        $idActivite = $activite['idActivite'];
                                    }


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

        <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes events</h1><br>
                <div class="d-flex align-left">
                    <a class="btn btn-primary" href="events.php" role="button">Liste d'events</a>
                </div></div><br><br>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="quitterEvent.php" method="POST">
                            <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'nomEvent', 'Nom de l\'event');
                                    theadFill($order, 'dateEvent', 'Date');
                                    theadFill($order, 'lieuEvent', 'Lieu');
                                    theadFill($order, 'Quitter', 'Quitter');
                                    theadFill($order, 'presence', 'Signaler presence');
                                    ?>
                                </tr>
                            </thead>
                            <?php
                            $currentDate = date("Y-m-d");
                            $req = $db->query("SELECT * FROM participe, event WHERE idUser = $idUser AND participe.idEvent = event.idEvent AND dateEvent >= '$currentDate'");

                            $req->execute();
                            while ($event = $req->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $event['nomEvent'] . '</td>';
                                echo '<td>' . $event['dateEvent'] . '</td>';
                                echo '<td>' . $event['lieuEvent'] . '</td>';
                                echo '<td>' .'<input type="hidden" name="idUser" value="'.$idUser.'" >'.' <button type="submit"   class="btn btn-danger"  value="'.$event['idEvent'].'" name="idEvent" class="btn btn-danger">Quitter</button></form></td>';

                                if ($currentDate == $event["dateEvent"]) {
                                    echo "<form action='attendEvent.php' method='POST'>";
                                    echo "<input type='hidden' name='idEvent' value='" . $event["idEvent"] . "'>";
                                    echo "<input type='submit' name='attend' value='Signaler ma presence'>";
                                    echo "</form>";
                                }
                                echo '</tr>';
                            }
                            ?>
                        
                        </tbody>
                    </form>
                    </table>
            </div>
    </section>

        <?php include('includes/footer.php') ?>
    </main>
  </body>
</html>