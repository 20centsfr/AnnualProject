<?php //TODO

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('includes/db.php');


$q = "SELECT * FROM event";
$result = mysqli_query($db, $q);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $row["nomEvent"] . "</h2>";

    echo "<form action='attendEvent.php' method='POST'>";
    echo "<input type='hidden' name='idEvent' value='" . $row["id"] . "'>";
    echo "<input type='submit' name='attend' value='Signaler presence'>";
    echo "</form>";
  }
} else {
  echo "Aucun événement trouvé.";
}
?>
