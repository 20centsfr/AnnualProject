<?php //TODO

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');

$idEvent = $_GET["id"];

$q = "SELECT user.prenom, user.nom, event_attendees.attended FROM event_attendees INNER JOIN user ON event_attendees.idUser = user.id WHERE event_attendees.idEvent = $idEvent";
$result = mysqli_query($db, $q);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $attended = $row["attended"] ? "Oui" : "Non";
    echo "<tr><td>" . $row["prenom"] . $row["nom"] . "</td><td>" . $attended . "</td></tr>";
  }
} else {
  echo "<tr><td colspan='2'>Aucun participant trouvé.</td></tr>";
}
?>
