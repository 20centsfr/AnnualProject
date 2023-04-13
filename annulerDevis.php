<?php

    include('includes/userInfo.php');
    include ('includes/connected.php');

    if(isset($_POST['idDevis']))
        $idDevis = htmlspecialchars($_POST['idDevis']);
    else
        header('location:reservations.php');

    
    $req = $db->query("SELECT prix FROM devis WHERE idUser='" . $idUser . "'");
    $req->execute() ;
    $devis = $req->fetch();

    if($devis != false){
        $q = $db->prepare("DELETE FROM devis WHERE idDevis = :idDevis");
        $q->execute([
        'idDevis' => $idDevis
        ]);
        header('location:reservations.php?message=Devis supprimé');
    }
    else
        header('location:reservations.php');


?>