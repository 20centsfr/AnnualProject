<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require('includes/db.php');

$q = "SELECT idActivite, nomActivite FROM activite WHERE nomActivite LIKE ?";
$req = $db->prepare($q);
$string = '%' . $_GET['value'] . '%';
$req->execute([$string]);

$res = $req->fetchAll();
if ($res) {
  echo '<table>';
  echo '<tr>';
  echo '<br>';
  echo '</tr>';
  foreach ($res as $key => $value) {
    echo '<tr>';
    echo '<td><a href="activite.php?Activite='.$value['idActivite'].'" target="_blank" class="list-group-item-action p-2">'.$value['nomActivite'].'</a></td>';
    echo '</tr>';

  }
  echo '</table>';
} else {
  echo '<a href="#" class="list-group-item-action p-2">Aucun résultat trouvé</a>';
}

?>
