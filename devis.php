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
  $page="Devis";

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
        <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: #f9f9f9;
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
            background-color: #e7eaef;
            backdrop-filter: saturate(200%) blur(25px);
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: #8313c4">
                FAIRE UN <br />
                <span style="color: #400861">DEVIS</span>
                </h1>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">



                <form action="verifDevis.php" method="POST">
                    <div class="form-outline mb-4">
                        <label for="activites">Entreprise</label><br>
                        <input type="text" name="nomEntreprise" id="nomEntreprise" class="form-control"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="activites">Nombre de participants</label><br>
                        <input type="text" name="nbParticipants" id="nbParticipants" class="form-control"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="activites">Sélectionnez les activités :</label><br>
                        <?php
                            $select = $db->query("SELECT * FROM activite");

                            if ($select->rowCount() > 0) {
                                while ($row = $select->fetch()) {
                                    echo '<input type="checkbox" name="activites[]" value="' . $row["idActivite"] . '"> ' . $row["nomActivite"] . ' (' . $row["tarifActivite"] . '€)<br>';
                                }
                            } else {
                                echo "Aucune activité n'a été trouvée dans la base de données.";
                            }
                        ?>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="prestataires">Sélectionnez les prestataires :</label><br>
                        <?php
                            $select = $db->query("SELECT * FROM prestataire");

                            if ($select->rowCount() > 0) {
                                while ($row = $select->fetch()) {
                                    echo '<input type="checkbox" name="activites[]" value="' . $row["idPrestataire"] . '"> ' . $row["nomPrestataire"] . ' : ' . $row["service"]. ' (' . $row["prixService"] . '€)<br>';
                                }
                            } else {
                                echo "Aucun prestataire n'a été trouvé dans la base de données.";
                            }
                        ?>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="materiels">Sélectionnez les matériels :</label><br>
                        <?php
                            $select = $db->query("SELECT * FROM materiel");

                            if ($select->rowCount() > 0) {
                                while ($row = $select->fetch()) {
                                    echo '<input type="checkbox" name="materiels[]" value="' . $row["idMateriel"] . '"> ' . $row["nomMateriel"] . ' (' . $row["prixMateriel"] . '€)<br>';
                                }
                            } else {
                                echo "Aucune activité n'a été trouvée dans la base de données.";
                            }
                        ?>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block mb-4">Obtenir un devis</button>

                </form>


                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>

  </body>

</html>