<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php 
include('includes/header.php');
include('includes/userInfo.php');
include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
                    <form action="verifReserveDevis.php" method="POST">
                        <!--faire ça pour chaque activite -->

                        <div class="form-outline mb-4">
                            <label class="form-label">Date</label>
                            <input type="date" name="dateChoisi" id="dateChoisi" class="form-control" required min="<?php echo date('Y-m-d'); ?>"/>
                        </div>

                        <div class="form-outline mb-4">
                            <label for="horaires">Choisissez un horaire :</label><br>
                            <?php
                                $select = $db->query("SELECT * FROM horaires");

                                if ($select->rowCount() > 0) {
                                    while ($row = $select->fetch()) {
                                        echo '<input type="radio" name="horaires[]" value="' . $row["idHoraires"] . '"> ' . $row["heureDebut"] . ' - ' . $row["heureFin"] . '<br>';
                                    }
                                } else {
                                    echo "Aucun horaire n'est disponible.";
                                }
                            ?>
                        </div>
                        <br>
                        <div class="form-outline mb-4">
                            <label class="form-label">Salle</label><br>
                            <?php
                            $select = $db->query("SELECT * FROM salle");

                            if ($select->rowCount() > 0) {
                                while ($row = $select->fetch()) {
                                    echo '<input type="radio" name="salles[]" value="' . $row["idSalle"] . '"> ' . $row["numSalle"] . ' (' . $row["nbPlaceSalle"] . ' places)<br>';
                                }
                            } else {
                                echo "Aucune salle n'est disponible.";
                            }
                            ?>
                        </div>
                        <br>
                        <!--<label for="salles">Salles disponibles :</label><br>
                        <select id="salles" name="idSalle">
                            <option value="">Choisissez une salle :</option>
                        </select> <br><br>


                        <script>
                            $(document).ready(function() {
                                $('input[name="horaires[]"]').on('change', function() {
                                    var idHoraires = $(this).val();

                                    $.ajax({
                                        url: 'salles.php',
                                        method: 'POST',
                                        data: { idHoraires: idHoraires },
                                        dataType: 'html',
                                        success: function(response) {
                                            $('#salles').html(response);
                                        }
                                    });
                                });
                            });
                        </script>
                        -->

                        <?php echo '<input type="hidden" name="idUser" value="'.$idUser.'" >';?>
                        <?php echo '<input type="hidden" name="idDevis" value="'.$idDevis.'" >';?>

                        <?php include 'includes/message.php'; ?>
                        <button type="submit" class="btn btn-primary btn-block mb-4">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </main>
  </body>
</html>