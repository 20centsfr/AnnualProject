<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/logo.png">
</head>

<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_dashboard.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="admin_activites.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Activités</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_blacklist.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Blacklist</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_connexion.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Connexions</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_event.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Events</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_lieux.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Lieux</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_materiels.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Matériels</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_messages.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Messages</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_fidelite.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Offres de fidelité</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin_prest.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Prestataires</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_paiements.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Paiements</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_reservations.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Reservations</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_salles.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Salles et lieux</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_planning.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Suivi d'activités</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="admin_users.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Utilisateurs</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Chercher..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                <!--<div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="index.php" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Deconnexion
                            </a>
                        </div>
                    </li> -->
                </ul>
            </nav>