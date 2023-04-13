<?php 

include 'includes/db.php';
include 'includes/header_admin.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "idActivite";
}
$select = $db->query("SELECT * FROM activite ORDER by $order");

function theadFill($order, $value, $disp) {
    if ($order == $value)
        echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
    else
        echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php include('includes/header.php'); ?>

  <body>
    <main class="main" id="top">
        <section class="background-radial-gradient overflow-hidden">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Activités</h1>
                <a href="addActivite.php" class="btn btn-success">Créer activité</a><br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data"  method="post" action="gestionActivite.php">
                                <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Nom', 'Nom');
                                    theadFill($order, 'Description', 'Description');
                                    theadFill($order, 'Nombre de places', 'Nombre de places');
                                    theadFill($order, 'Tarif', 'Tarif');
                                    theadFill($order, 'Lieu', 'Lieu');
                                    theadFill($order, 'Duree', 'Duree');
                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $select = $db->query("SELECT * FROM activite");
                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idActivite'] . '</td>';
                                    echo '<td>' . $content['nomActivite'] . '</td>';
                                    echo '<td>' . $content['descriptionActivite'] . '</td>';
                                    echo '<td>' . $content['nbPlacesActivite'] . '</td>';
                                    echo '<td>' . $content['tarifActivite'] . '</td>';
                                    echo '<td>' . $content['localActivite'] . '</td>';
                                    echo '<td>' . $content['dureeActivite'] . '</td>';
                                    echo '<td> <button type="submit" value="'.$content['idActivite'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                                    echo '<td> <button type="submit" value="'.$content['idActivite'].'" name="Modifier" class="btn btn-success">Modifier</button></td>';
                                    echo '</tr>';
                                }
                                ?>
                                </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
    </body>
</html>