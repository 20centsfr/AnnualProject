<?php

include 'includes/db.php';
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (!$db) {
  die("Echec: " . mysqli_connect_error());
}

$q = "SELECT page, COUNT(*) as visites FROM logs GROUP BY page";
$res = mysqli_query($db, $q);
var_dump($res);

$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

header('Content-Type: application/json');
var_dump($data);
echo json_encode($data);

mysqli_close($db);
?>
