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
    $order = "idLieu";
}
$select = $db->query("SELECT * FROM lieu ORDER by $order");

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
                <h1 class="h3 mb-2 text-gray-800">Lieux</h1>
                <a href="addLieu.php" class="btn btn-success">Ajouter lieu</a><br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data"  method="post" action="gestionLieu.php">
                                <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Nom', 'Nom');
                                    theadFill($order, 'Adresse', 'Adresse');
                                    theadFill($order, 'Code Postal', 'Code Postal');
                                    theadFill($order, 'Ville', 'Ville');
                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $select = $db->query("SELECT * FROM lieu");
                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idLieu'] . '</td>';
                                    echo '<td>' . $content['nomLieu'] . '</td>';
                                    echo '<td>' . $content['adresse'] . '</td>';
                                    echo '<td>' . $content['codePostal'] . '</td>';
                                    echo '<td>' . $content['villeLieu'] . '</td>';
                                    echo '<td> <button type="submit" value="'.$content['idLieu'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                                    echo '<td> <button type="submit" value="'.$content['idLieu'].'" name="Modifier" class="btn btn-success">Modifier</button></td>';
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