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

    $req = $db->prepare("SELECT * FROM devismateriel WHERE idDevis = :idDevis");
    $req->execute([
        'idDevis' => $idDevis
        ]) ;
    $materiel = $req->fetch();

    if($materiel){
        $q = $db->prepare("DELETE FROM devismateriel WHERE idDevis = :idDevis");
        $q->execute([
            'idDevis' => $idDevis
            ]);
    }

    if($devis != false){
        $q = $db->prepare("DELETE FROM devis WHERE idDevis = :idDevis");
        $q->execute([
        'idDevis' => $idDevis
        ]);
        header('location:reservations.php?message=Devis supprimé&type=success');
    }
    else
        header('location:reservations.php');


?>