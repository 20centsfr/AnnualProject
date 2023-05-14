<?php
include('includes/db.php');
session_start();

$code = $_POST['coupon'];
$prix = $_POST['prix'];

$q = $db->query("SELECT * FROM fidelite WHERE code = '$code' && status = 1");
$count = mysqli_num_rows($q);
$res = mysqli_fetch_array($q);
$tab = array();
if($count > 0){
    $reduc = $res['reduc'] / 100;
    $total = $reduc * $prix;
    $tab['reduc'] = $res['reduc'];
    $tab['prix'] = $prix - $total;

    header('location: index.php?message=Succes');
    exit;
    echo json_encode($tab);

} else {
    header('location:profile.php?message=NON.');
}
?>