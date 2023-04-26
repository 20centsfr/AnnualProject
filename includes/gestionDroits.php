<?php 

require_once 'includes/db.php';

// 1 = admin
// 0 = utilisateur

if(isset($_SESSION['email'])){
    $q = 'SELECT admin FROM user WHERE email = "' . $_SESSION['email'] . '"';
    $select = $db->query($q);
    
    $search = $select->fetchAll();
    $admin = $search[0]['admin'];
 }
 


?>