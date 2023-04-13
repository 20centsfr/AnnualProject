<?php 
include 'includes/db.php';
include ('includes/connected.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php include('includes/header.php') ?>

  <body>
    <main class="main" id="top">
    <?php include('includes/nav.php') ?>
  
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
                NOUVEL <br />
                <span style="color: hsl(218, 81%, 75%)">&EVENEMENT</span>
                </h1>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div class="card bg-glass">
                <div class="card-body px-4 py-5 px-md-5">
                    <form action="verificationAddEvent.php" method="POST">
                    <div class="form-outline mb-4">
                        <input type="text" name="nomEvent" id="nomEvent" class="form-control" required/>
                        <label class="form-label">Nom de l'event</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="descriptionEvent" id="descriptionEvent" class="form-control" required/>
                        <label class="form-label">Description</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="nbPlacesEvent" id="nbPlacesEvent" class="form-control" required/>
                        <label class="form-label">Nombre de places</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="nbPointsEvent" id="nbPointsEvent" class="form-control" required/>
                        <label class="form-label">Points</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="lieuEvent" id="lieuEvent" class="form-control" required/>
                        <label class="form-label">Lieu</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="date" name="dateEvent" id="dateEvent" class="form-control" required/>
                        <label class="form-label">Date</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="time" name="heureEvent" id="heureEvent" class="form-control" required/>
                        <label class="form-label">Heure</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4">Créer</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <footer>
            <?php include('includes/footer.php') ?>
        </footer>
    </main>
  </body>
</html>