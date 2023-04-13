<?php //todo
include 'includes/db.php';
include 'includes/header_admin.php';
include ('includes/gestionDroits.php');
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

        if (isset($_GET['order'])){
            $order = $_GET['order'];
        } else {
            $order = "idReservation"; }

        $select = $db->query("SELECT * FROM reservation ORDER by $order");

        function theadFill($order, $value, $disp)
        {
        if ($order == $value)
            echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
        else
            echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
        }
    ?>

            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Utilisateurs</h1>
                <br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data" method="post" action="gestionUser.php">
                                <thead>

                                <tr>
                                    <?php
                                    theadFill($order, 'idReservation', 'ID');
                                    theadFill($order, 'prenom', 'prenom');
                                    theadFill($order, 'nom', 'nom');
                                    theadFill($order, 'email', 'Email');
                                    theadFill($order, 'entreprise', 'entreprise');
                                    theadFill($order, 'admin', 'admin');
                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                    <?php
                                    $select = $db->query("SELECT * FROM user");

                                    while ($content = $select->fetch()) {
                                        echo '<tr>';
                                        echo '<td>'.$content['idReservation'] .'</td>';
                                        echo '<td>'.$content['prenom'].'</td>';
                                        echo '<td>'.$content['nom'].'</td>';
                                        echo '<td>'.$content['email'] .'</td>';
                                        echo '<td>'.$content['entreprise'] .'</td>';
                                        echo '<td>'.$content['admin'].'</td>';

                                        echo '<td> <button type="submit" value="'.$content['idReservation'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
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