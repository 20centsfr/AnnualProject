<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');


if (isset($_POST['idHoraires'])) {
    $idHoraires = $_POST['idHoraires'];

    $q = "SELECT * FROM salle WHERE idSalle NOT IN (SELECT idSalle FROM reservation WHERE idHoraires = :idHoraires)";
    $stmt = $pdo->prepare($q);
    $stmt->bindParam(':idHoraires', $idHoraires);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        echo '<option value="">Choisissez une salle</option>';

        foreach ($rows as $row) {
            echo '<option value="' . $row['idSalle'] . '">' . $row['nomSalle'] . ' (' . $row['nbPlaceSalle'] . ')</option>';
            //echo '<input type="radio" value="' . $row['idSalle'] . '">' . $row['nomSalle'] . ' (' . $row['nbPlaceSalle'] . ')</option>';
        }
    } else {
        echo '<option value="">Aucune salle disponible</option>';
    }
}

?>
