<?php 
require_once 'includes/db.php';
include "gestionDroits.php";
?>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="light">
    <div class="container"><a class="navbar-brand" href="index.php"><img src="assets/img/icons/logo.png" height="50" alt="logo" /></a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-center">
          <li class="nav-item"><a class="nav-link px-3" href="activites.php">Activités</a></li>
          <?php 
          if(isset($_SESSION['email'])){
            echo '<li class="nav-item"><a class="nav-link px-3" href="reservations.php">Devis et réservations</a></li>';
            echo '<li class="nav-item"><a class="nav-link px-3" href="planning.php">Planning</a></li>';
            echo '<li class="nav-item"><a class="nav-link px-3" href="profile.php">Profil</a></li>';
            if($admin==1){
              echo '<li class="nav-item"><a class="nav-link px-3" href="admin_dashboard.php">Admin</a></li>';
            } 
            

          } ?>
              
        </ul>
        <?php 
          if(isset($_SESSION['email'])){
            echo '<a class="btn btn-primary" href="deconnexion.php" role="button">Deconnexion</a>';
          } else {
            echo '<a class="btn btn-primary" href="connexion.php" role="button">Connexion</a>';
          }
          ?>
        
      </div>
    </div>
  </nav>

