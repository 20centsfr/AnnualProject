<?php 
include 'includes/db.php';
include 'includes/header_admin.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <body>
    <main class="main" id="top">
    <div class="container-fluid" xmlns="http://www.w3.org/1999/html">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Utilisateurs</div>
                                            <?php
                                            $select = $db->query("SELECT count(idUser) as idUser FROM user");
                                            $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idUser'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Activités</div>
                                        <?php

                                        $select = $db->query("SELECT count(idActivite) as idActivite  FROM activite ");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idActivite'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Events</div>
                                        <?php

                                        $select = $db->query("SELECT count(idEvent) as idEvent  FROM event");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idEvent'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Lieux</div>
                                        <?php

                                        $select = $db->query("SELECT count(idLieu) as idLieu  FROM lieu");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idLieu'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Reservations</div>
                                        <?php

                                        $select = $db->query("SELECT count(idReservation) as idReservation  FROM reservation");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idReservation'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de connexions aujourd'hui</div>
                                        <?php
                                        $date=Date('Y-m-d');
                                        echo $date;
                                        $select = $db->query("SELECT count(idLogs) as idLogs  FROM logs WHERE date='$date' ");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idLogs'].'</div>';
                                        ?>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de connexions total</div>
                                        <?php

                                        $select = $db->query("SELECT count(idLogs) as idLogs FROM logs ");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idLogs'].'</div>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     </main>
</body>
</html>
