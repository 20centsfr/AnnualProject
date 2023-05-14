<?php 

include 'includes/db.php';
include ('includes/gestionDroits.php');
include 'includes/header_admin.php';

if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "idMateriel"; 
}
$select = $db->query("SELECT * FROM materiel ORDER by $order");

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
                <h1 class="h3 mb-2 text-gray-800">Matériels</h1>
                <a href="addMateriel.php" class="btn btn-success">Ajouter materiel</a><br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data"  method="post" action="gestionMateriel.php">
                                <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Nom', 'Numero');
                                    theadFill($order, 'Nombre de places', 'Nombre de places');
                                    theadFill($order, 'types', 'Type');

                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $select = $db->query("SELECT * FROM materiel");
                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idMateriel'] . '</td>';
                                    echo '<td>' . $content['nomMateriel'] . '</td>';
                                    echo '<td>' . $content['quantiteMateriel'] . '</td>';
                                    echo '<td>' . $content['typeMateriel'] . '</td>';
                                    echo '<td> <button type="submit" value="'.$content['idMateriel'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                                    echo '<td> <button type="submit" value="'.$content['idMateriel'].'" name="Modifier" class="btn btn-success">Modifier</button></td>';
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