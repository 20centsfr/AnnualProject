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
                                    theadFill($order, 'Date', 'Date');
                                    theadFill($order, 'entreprise', 'Entreprise');
                                    theadFill($order, 'prix', 'Prix');
                                    theadFill($order, 'Participants', 'Participants');
                                    theadFill($order, 'Activités', 'Activités');
                                    theadFill($order, 'Horaire', 'Horaire');
                                    theadFill($order, 'Salle', 'Salle');
                                    theadFill($order, 'modifier', 'Modifier');
                                    ?>
                                </tr>
                                </thead>

                                <?php
                                $select = $db->query("SELECT * FROM reservation");

                                while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>'.$content['idReserve'] .'</td>';
                                    echo '<td>'.$content['dateChoisi'].'</td>';
                                    $userReq = $db->query("SELECT entreprise FROM user WHERE idUser=".$content['idUser']);
                                    while ($cont = $userReq->fetch()) {
                                        echo '<td>'.$cont['entreprise'] .'</td>';
                                    }
                                    echo '<td>'.$content['prix'] .'€</td>';

                                    echo '<td>'.$content['nbParticipants'].'</td>';         

                                    $activiteReq = $db->query("SELECT nomActivite FROM activiteReserve INNER JOIN activite ON activiteReserve.idActivite = activite.idActivite WHERE idReserve='" . $content['idReserve'] . "'");
                                    echo '<td>';
                                    while ($activite = $activiteReq->fetch()) { 
                                    echo $activite['nomActivite'] . '</td>'; 
                                    }

                                    $horaireReq = $db->query("SELECT heureDebut, heureFin FROM horaireReserve INNER JOIN horaires ON horaireReserve.idHoraires = horaires.idHoraires WHERE idReserve='" . $content['idReserve'] . "'");
                                    echo '<td>';
                                    while ($horaire = $horaireReq->fetch()) { 
                                    echo '<td>'.$horaire['heureDebut'] .' - ' . $horaire["heureFin"] .'</td>'; 
                                    }

                                    $salleReq = $db->query("SELECT numSalle, dispoSalle FROM horaireReserve INNER JOIN salle ON horaireReserve.idSalle = salle.idSalle WHERE idReserve='" . $content['idReserve'] . "'");
                                    $numRows = $salleReq->rowCount(); 

                                    if ($numRows == 0) { 
                                        echo '<td><select name="salle">';
                                        $salleReq = $db->query("SELECT idSalle, numSalle, nbPlaceSalle FROM salle WHERE dispoSalle=1");
                                        while ($salleDispo = $salleReq->fetch()) { 
                                            $idSalle = $salleDispo['idSalle'];
                                            echo '<option value="' . $salleDispo['numSalle'] . '">Salle ' . $salleDispo['numSalle'] . ' ('.$salleDispo['nbPlaceSalle'] .')</option>';
                                        }
                                        echo '</select></td>';
                                    } else {
                                        while ($salle = $salleReq->fetch()) { 
                                            echo '<td>'.$salle['numSalle'].'</td>'; 
                                        }
                                    }
                                    echo '<input type="hidden" name="idSalle" value="' . $idSalle . '" >';

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