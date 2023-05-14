
<?php 
include 'includes/db.php';
include ('includes/gestionDroits.php');
include 'includes/header_admin.php';

if (isset($_GET['order']))
    $order = $_GET['order'];
else
    $order = "idLogs";
$select = $db->query("SELECT * FROM logs ORDER by $order");

function theadFill($order, $value, $disp)
{
    if ($order == $value)
        echo '<th><a href="?order=' . $value . ' DESC">' . $disp . '</a></th>';
    else
        echo '<th><a href="?order=' . $value . '">' . $disp . '</a></th>';
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Connexions</h1>
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form enctype="multipart/form-data" method="post" action="gestionLogs.php">
                        <thead>
                        <tr>
                            <?php
                            theadFill($order, 'idLogs', 'ID');
                            theadFill($order, 'page', 'Page');
                            theadFill($order, 'date', 'Date');
                            theadFill($order, 'heure', 'heure');
                            theadFill($order, 'ip', 'IP');
                            ?>
                        </tr>
                        </thead>

                        <?php

                        $select = $db->query("SELECT * FROM logs");
                        while ($content = $select->fetch()) {
                            echo '<tr>';
                            echo '<td>'.$content['idLogs'] .'</td>';
                            echo '<td>'.$content['page'].'</td>';
                            echo '<td>'.$content['date'].'</td>';
                            echo '<td>'.$content['heure'] .'</td>';
                            echo '<td>'.$content['ip'] .'</td>';
                            echo '<td> <button type="submit" value="'.$content['idLogs'].'" name="Supprimer" class="btn btn-danger">Supprimer</button></td>';
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