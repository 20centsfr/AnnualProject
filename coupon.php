<?php
include('includes/db.php');
session_start();

$code = $_POST['coupon'];
$prix = $_POST['prix'];

$q = mysqli_query($conn, "SELECT * FROM fidelite WHERE code = '$code' && status = 1") or die(mysqli_error());
$count = mysqli_num_rows($q);
$fetch = mysqli_fetch_array($q);
$array = array();
if($count > 0){
    $discount = $fetch['discount'] / 100;
    $total = $discount * $prix;
    $array['discount'] = $fetch['discount'];
    $array['prix'] = $prix - $total;

    echo json_encode($array);

} else {
    echo "error";
}
?>