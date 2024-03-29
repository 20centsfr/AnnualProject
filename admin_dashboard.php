<?php 
include 'includes/db.php';
include "includes/gestionDroits.php";
include 'includes/header_admin.php';


?>

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
                                            Salles</div>
                                        <?php

                                        $select = $db->query("SELECT count(idSalle) as idSalle  FROM salle");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idSalle'].'</div>';
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
                                            Matériel</div>
                                        <?php

                                        $select = $db->query("SELECT count(idMateriel) as idMateriel  FROM materiel");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idMateriel'].'</div>';
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
                                            Prestataires</div>
                                        <?php

                                        $select = $db->query("SELECT count(idPrestataire) as idPrestataire  FROM prestataire");
                                        $content = $select->fetch();
                                        echo'<div class="h5 mb-0 font-weight-bold text-gray-800">' .$content['idPrestataire'].'</div>';
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
