<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 

include('includes/header.php');
include('includes/userInfo.php');
include ('includes/connected.php');

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

        <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes devis</h1><br><br>
                <?php include('includes/message.php') ?>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="annulerDevis.php" method="post">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'prix', 'Prix');
                                theadFill($order, 'date', 'Date');
                                theadFill($order, 'Supprimer', 'Supprimer');
                                theadFill($order, 'Réserver', 'Réserver');
                                ?>
                            </tr>
                            </thead>

                            <?php
                            
                                $req = $db->query("SELECT * FROM devis WHERE idUser='" . $idUser . "'");

                                $req->execute() ;
                                while ($devis = $req->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $devis['prix'] . '</td>';
                                    echo '<td>' . $devis['date'] . '</td>';
                                    echo '<td>';
                                    echo '<form action="annulerDevis.php" method="post" style="display: inline-block;">';
                                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                                    echo '<button type="submit" class="btn btn-danger" name="idDevis" value="'.$devis['idDevis'].'">Supprimer</button>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<form action="reserverDevis.php" method="post" style="display: inline-block;">';
                                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                                    echo '<button type="submit" class="btn btn-success" name="idDevis" value="'.$devis['idDevis'].'">Réserver</button>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                        </form>
                        </tbody>
                    </table>
                </div>
            </section>


        <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes activités</h1><br><br>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="annuler.php" method="post">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'nomActivite', 'Nom de l\'activite');
                                theadFill($order, 'Annuler', 'Annuler');
                                
                                ?>
                            </tr>
                            </thead>

                            <?php
                            $req = $db->query('SELECT * FROM reserve, activite where idUser = ' . $idUser . ' AND reserve.idActivite = activite.idActivite');

                            $req->execute() ;
                            while ($activite = $req->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $activite['nomActivite'] . '</td>';
                                echo '<td>' .'<input type="hidden" name="idUser" value="'.$idUser.'" >'.' <button type="submit"   class="btn btn-primary" value="'.$activite['idActivite'].'" name="idActivite" class="btn btn-danger">Annuler</button></form></td>';
                                echo '</tr>';
                            }
                            ?>
                        </form>
                        </tbody>
                    </table>
            </div>
        </section>

        <section class="container">
            <div class="row col-12">
                <br><br><br><br><br><br>
                <h1>Mes events</h1><br><br>
                <div class="overflow-auto">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <form action="quitterEvent.php" method="post">
                            <thead>
                            <tr>
                                <?php
                                theadFill($order, 'nomEvent', 'Nom de l\'event');
                                theadFill($order, 'dateEvent', 'Date de l\'event');
                                theadFill($order, 'heureEvent', 'Heure de l\'event');
                                ?>
                            </tr>
                            </thead>

                            <?php
                            $req = $db->query('SELECT * FROM participe, event where idUser = ' . $idUser . ' AND participe.idEvent = event.idEvent');

                            $req->execute() ;
                            while ($event = $req->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $event['nomEvent'] . '</td>';
                                echo '<td>' . $event['dateEvent'] . '</td>';
                                echo '<td>' . $event['heureEvent'] . '</td>';
                                echo '<td>' .'<input type="hidden" name="idUser" value="'.$idUser.'" >'.' <button type="submit"   class="btn btn-primary" value="'.$event['idEvent'].'" name="idEvent" class="btn btn-danger">Annuler</button></form></td>';
                                echo '</tr>';
                            }
                            ?>
                        </form>
                        </tbody>
                    </table>
            </div>
        </section>

        <?php include('includes/footer.php') ?>
    </main>
  </body>
</html>