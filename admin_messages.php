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
    $order = "idUser";
}
$select = $db->query("SELECT * FROM user ORDER by $order");

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
                <h1 class="h3 mb-2 text-gray-800">Messages</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <form enctype="multipart/form-data"  method="post" action="suppMessage.php">
                                <thead>
                                <tr>
                                    <?php
                                    theadFill($order, 'ID', 'ID');
                                    theadFill($order, 'Adresse mail', 'Adresse mail');
                                    theadFill($order, 'Message', 'Message');
                                    ?>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $select = $db->query("SELECT idUser, email, message FROM user WHERE message IS NOT NULL AND message <> ''");
                                    while ($content = $select->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . $content['idUser'] . '</td>';
                                    echo '<td>' . $content['email'] . '</td>';
                                    echo '<td>' . $content['message'] . '</td>';
                                    echo '<td> <button type="submit" value="'.$content['idUser'].'" name="Supprimer" class="btn btn-success">Supprimer</button></td>';
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