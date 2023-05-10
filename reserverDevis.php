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

                <?php
                $idActivites = array();
                $activiteReq = $db->prepare("SELECT activite.idActivite, nomActivite FROM devisactivites INNER JOIN activite ON devisactivites.idActivite = activite.idActivite WHERE idDevis = ?");
                $activiteReq->execute([$idDevis]);
                while ($activite = $activiteReq->fetch()) {
                    echo $activite['nomActivite'] . '<br>';
                    $idActivite = $activite['idActivite'];
                    
                    echo '<form action="verifReserveDevis.php" method="POST">';
                    
                    echo '<div class="form-outline mb-4">';
                    echo '<label class="form-label">Date</label>';
                    echo '<input type="date" name="dateChoisi_'.$idActivite.'" id="dateChoisi_'.$idActivite.'" class="form-control" required min="'.date('Y-m-d').'"/>';
                    echo '</div>';
                    
                    echo '<div class="form-outline mb-4">';
                    echo '<label for="horaires_'.$idActivite.'">Choisissez un horaire :</label><br>';
                    $select = $db->query("SELECT * FROM horaires");
                    if ($select->rowCount() > 0) {
                        while ($row = $select->fetch()) {
                            echo '<input type="radio" name="horaires_'.$idActivite.'[]" value="'.$row["idHoraires"].'"> '.$row["heureDebut"].' - '.$row["heureFin"].'<br>';
                        }
                    } else {
                        echo "Aucun horaire n'est disponible.";
                    }
                    echo '</div>';

                    echo '<div class="form-outline mb-4">';
                    echo '<label class="form-label">Salle</label><br>';
                    $select = $db->query("SELECT * FROM salle WHERE dispoSalle = 1");
                    if ($select->rowCount() > 0) {
                        while ($row = $select->fetch()) {
                            echo '<input type="radio" name="salles_'.$idActivite.'[]" value="'.$row["idSalle"].'"> '.$row["numSalle"].' ('.$row["nbPlaceSalle"].' places)<br>';
                        }
                    } else {
                        echo "Aucune salle n'est disponible.";
                    }
                    echo '</div>';
                    
                    echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';
                    echo '<input type="hidden" name="idDevis" value="'.$idDevis.'" >';
                    echo '<input type="hidden" name="idActivite" value="'.$idActivite.'" >';

                    echo '<button type="submit" class="btn btn-primary btn-block mb-4">Réserver</button>';
                    echo '</form>';
                }
                ?>

                </div>
            </div>
        </div>
    </section>
    </main>
  </body>
</html>