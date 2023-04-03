<?php //prestataires et prestations
//todo
include 'includes/db.php';
include 'includes/header_admin.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_GET['order']))
    $order = $_GET['order'];
else
    $order = "idPrestataire";
    $select = $db->query("SELECT * FROM prestataire ORDER by $order");


function theadFill($order, $value, $disp)
{
    if ($order == $value)
        echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
    else
        echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Prestataires</h1>
    <a href="addPrest.php" class="btn btn-success">Ajouter un prestataire</a><br><br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form enctype="multipart/form-data" method="post" action="gestionPrest.php">
                        <thead>
                        <tr>
                            <?php
                            theadFill($order, 'idPrestataire', 'ID');
                            theadFill($order, 'nom', 'Nom');
                            theadFill($order, 'email', 'Email');
                            theadFill($order, 'service', 'Service');
                            theadFill($order, 'secteur', 'Secteur');
                            theadFill($order, 'supprimer', 'Supprimer');
                            ?>
                        </tr>
                        </thead>

                        <?php

                        $select = $db->query("SELECT * FROM prestataire");
                        while ($content = $select->fetch()) {
                            echo '<tr>';
                            echo '<td>'.$content['idPrestataire'] .'</td>';
                            echo '<td>'.$content['nomPrestataire'].'</td>';
                            echo '<td>'.$content['emailPrestataire'].'</td>';
                            echo '<td>'.$content['service'] .'</td>';
                            echo '<td>'.$content['secteurActivite'].'</td>';
                            echo '<td> <button type="submit" value="'.$content['idPrestataire'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<footer>
    <?php include('includes/footer.php'); ?>
</footer>
</div>
</div>

</body>
</html>