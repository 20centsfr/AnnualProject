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
    $order = "idPaiement";
}
$select = $db->query("SELECT * FROM paiement ORDER by $order");

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
                <h1 class="h3 mb-2 text-gray-800">Paiement</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <form enctype="multipart/form-data"  method="post" action="suppPaiement.php">
                            <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Nom', 'Nom');
                                    theadFill($order, 'Prenom', 'Prenom');
                                    theadFill($order, 'Adresse mail', 'Adresse mail');
                                    theadFill($order, 'Montant', 'Montant');
                                    theadFill($order, 'Date', 'Date');
                                    ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $select = $db->query("SELECT * FROM paiement");
                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idPaiement'] . '</td>';
                                    echo '<td>' . $content['prenom'] . '</td>';
                                    echo '<td>' . $content['nom'] . '</td>';
                                    echo '<td>' . $content['email'] . '</td>';
                                    echo '<td>' . $content['montant'] . ' c</td>';
                                    echo '<td>' . $content['date'] . ' </td>';
                                    echo '<td> <button type="submit" value="'.$content['idPaiement'].'" name="Supprimer" class="btn btn-success">Supprimer</button></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            </form>
                        </table>
                        </div>
                    </div>
                </div>
            </main>
    </body>
</html>