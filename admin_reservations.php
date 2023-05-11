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
            $order = "idReserve"; }

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
                <h1 class="h3 mb-2 text-gray-800">Reservations</h1>
                <br><br>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data" method="post" action="gestionReserve.php">
                                <thead>

                                <tr>
                                    <?php
                                    theadFill($order, 'idReserve', 'ID');
                                    theadFill($order, 'entreprise', 'Entreprise');
                                    theadFill($order, 'nbParticipants', 'Nombre de participants');
                                    theadFill($order, 'Participants', 'Participants');
                                    theadFill($order, 'Horaire', 'Horaire');
                                    theadFill($order, 'Activités', 'Activités');
                                    theadFill($order, 'prix', 'Prix');
                                    theadFill($order, 'Date', 'Date');
                                    theadFill($order, 'modifier', 'Modifier');

                                    ?>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                    <?php
                                    $select = $db->query("SELECT * FROM reservation");

                                    while ($content = $select->fetch()) {
                                        echo '<tr>';
                                        echo '<td>'.$content['idReserve'] .'</td>';
                                        //echo '<td>'.$content['entreprise'] .'</td>';
                                        echo '<td>'.$content['nbParticipants'].'</td>';
                                        //echo '<td>'.$content['nom'].'</td>';
                                        echo '<td>'.$content['prix'] .'</td>';
                                        
                                        echo '<td>'.$content['dateChoisi'].'</td>';

                                        echo '<td> <button type="submit" value="'.$content['idReserve'].'" name="Annuler" class="btn btn-danger">Annuler</button></td>';
                                        echo '<td> <button type="submit" value="'.$content['idReserve'].'" name="Modifier" class="btn btn-danger">Modifier</button></td>';
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