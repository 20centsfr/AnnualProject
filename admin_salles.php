<?php 

include 'includes/db.php';
include 'includes/header_admin.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "idSalle";
}
$select = $db->query("SELECT * FROM salle ORDER by $order");

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
                <h1 class="h3 mb-2 text-gray-800">Salles</h1>
                <a href="addSalle.php" class="btn btn-success">Ajouter salle</a><br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data"  method="post" action="gestionSalles.php">
                                <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Nom', 'Numero');
                                    theadFill($order, 'dispoSalle', 'Disponibilité');
                                    theadFill($order, 'Nombre de places', 'Nombre de places');
                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $select = $db->query("SELECT * FROM salle");
                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idSalle'] . '</td>';
                                    echo '<td>' . $content['numSalle'] . '</td>';
                                    echo '<td>' . $content['dispoSalle'] . '</td>';
                                    echo '<td>' . $content['nbPlaceSalle'] . '</td>';
                                    echo '<td> <button type="submit" value="'.$content['idSalle'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                                    echo '<td> <button type="submit" value="'.$content['idSalle'].'" name="Modifier" class="btn btn-success">Modifier</button></td>';
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