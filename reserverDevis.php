<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/userInfo.php');
include ('includes/connected.php');

$idDevis = $_POST['idDevis'];

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
    $page="Reserver devis";
  
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
    <?php include('includes/nav.php'); ?>
    <section class="background-radial-gradient overflow-hidden">
          <br>
          <style>
                .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                    hsl(218, 41%, 35%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                    hsl(218, 41%, 45%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%);
                }

                #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
                }

                #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
                }

                .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
                }
            </style>        

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                TOGETHER <br />
                <span style="color: hsl(218, 81%, 75%)">&STRONGER</span>
                </h1>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">

                <?php include('includes/message.php') ?>

                <?php
                echo '<form action="verifReserveDevis.php" method="POST">';

                $activiteReq = $db->prepare("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis = ?");
                $activiteReq->execute([$idDevis]);
                $activites = $activiteReq->fetchAll(PDO::FETCH_ASSOC);

                foreach ($activites as $activite) {
                    echo $activite['nomActivite'] . '<br>';

                    echo '<div class="form-outline mb-4">';
                    echo '<label for="horaires_' . $activite['idActivite'] . '">Choisissez un horaire :</label><br>';

                    $dateChoisi = $_POST['dateChoisi'];
                    $select = $db->query("SELECT * FROM horaires");

                    if ($select->rowCount() > 0) {
                        while ($row = $select->fetch()) {
                            $horaireDejaReserve = $db->query("SELECT idHoraires FROM horaireReserve WHERE dateChoisi = '$dateChoisi' AND idHoraires = '" . $row["idHoraires"] . "'");

                            if ($horaireDejaReserve->rowCount() == 0) {
                                echo '<input type="radio" name="horaires_' . $activite['idActivite'] . '" value="' . $row["idHoraires"] . '"> ' . $row["heureDebut"] . ' - ' . $row["heureFin"] . '<br>';
                            } else {
                                echo '<input type="radio" name="horaires_' . $activite['idActivite'] . '" value="' . $row["idHoraires"] . '" disabled> ' . $row["heureDebut"] . ' - ' . $row["heureFin"] . ' (déjà réservé)<br>';
                            }
                        }
                    } else {
                        echo "Aucun horaire n'est disponible.";
                    }
                    $idActivites[] = $activite['idActivite'];

                    echo '<input type="hidden" name="dateChoisi" value="' . $dateChoisi . '" >';
                    echo '<input type="hidden" name="idUser" value="' . $idUser . '" >';
                    echo '<input type="hidden" name="idDevis" value="' . $idDevis . '" >';
                    echo '<input type="hidden" name="idActivite" value="' . htmlentities(json_encode($activites)) . '">';
                    echo '</div>';
                }

                echo '<button type="submit" class="btn btn-primary btn-block mb-4">Continuer</button>';
                echo '</form>';
                ?>


                </div>
            </div>
        </div>
    </section>
    </main>
  </body>
</html>