<?php 
include 'includes/db.php';
include ('includes/gestionDroits.php');
include 'includes/header_admin.php';

if (isset($_GET['order'])){
    $order = $_GET['order'];
} else {
    $order = "idUser"; }

$select = $db->query("SELECT * FROM user ORDER by $order");

function theadFill($order, $value, $disp)
{
if ($order == $value)
    echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
else
    echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Clients loyaux</h1>
    <br><br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form enctype="multipart/form-data" method="post" action="rien.php">
                    <thead>

                    <tr>
                        <?php
                        theadFill($order, 'idUser', 'ID');
                        theadFill($order, 'prenom', 'prenom');
                        theadFill($order, 'nom', 'Nom');
                        theadFill($order, 'email', 'Email');
                        theadFill($order, 'entreprise', 'Entreprise');
                        theadFill($order, 'admin', 'Nombre de points');
                        ?>
                    </tr>
                    </thead>

                    <?php
                    $select = $db->query("SELECT * FROM user WHERE nbPoints>=50");

                    while ($content = $select->fetch()) {
                        echo '<tr>';
                        echo '<td>'.$content['idUser'] .'</td>';
                        echo '<td>'.$content['prenom'].'</td>';
                        echo '<td>'.$content['nom'].'</td>';
                        echo '<td>'.$content['email'] .'</td>';
                        echo '<td>'.$content['entreprise'] .'</td>';
                        echo '<td>'.$content['nbPoints'] .'</td>';
                    }
                    ?>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Offres de fidelité</h1>
    <a href="addFidelite.php" class="btn btn-success">Créer offre de fidelité</a><br><br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form enctype="multipart/form-data" method="post" action="gestionFidelite.php">
                    <thead>

                    <tr>
                        <?php
                        theadFill($order, 'idFidelite', 'ID');
                        theadFill($order, 'nomFidelite', 'Nom de l offre');
                        theadFill($order, 'description', 'Description');
                        theadFill($order, 'points', 'Nombre de points necessaires');
                        theadFill($order, 'dateFin', 'Offre valable jusqua');
                        ?>
                    </tr>
                    </thead>

                    <?php
                    $select = $db->query("SELECT * FROM fidelite");

                    while ($content = $select->fetch()) {
                        echo '<tr>';
                        echo '<td>'.$content['idFidelite'] .'</td>';
                        echo '<td>'.$content['nomFidelite'].'</td>';
                        echo '<td>'.$content['description'].'</td>';
                        echo '<td>'.$content['points'] .'</td>';
                        echo '<td>'.$content['dateFin'] .'</td>';
                        echo '<td> <button type="submit" value="'.$content['idFidelite'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
                        echo '<td> <button type="submit" value="'.$content['idFidelite'].'" name="Modifier" class="btn btn-success">Modifier</button></td>';
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
<?php include 'includes/footer.php' ?>
</footer>
    </div>
</div>
</body>
</html>