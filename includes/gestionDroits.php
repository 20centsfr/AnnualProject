<?php 

include('includes/userInfo.php');

// 1 = admin
// 0 = utilisateur

if($role != 1){
    header('location: index.php');
    exit;
}

?>
