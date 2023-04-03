<?php //test

//VERIF PARTICIPATION ACTIVITE 

require('include/db.php');

$idUser=$_POST['idUser'];
$idActivite=$_POST['idActivite'];

$q = "SELECT * FROM participe WHERE idActivite = '$idActivite' and idUser = '$idUser' ";
$req = $db->prepare($q);
$req->execute([
]);

$resultat = $req->fetch();
if($resultat){
    header('location: assos.php?message=Vous participez deja a cet activité.&type=danger');
    exit;
}

$q = "INSERT INTO participe (idUser, idActivite) VALUES (:idUser, :idActivite)";
$req = $db->prepare($q);
$reponse = $req->execute([
    'idUser' => $idUser,
    'idActivite' =>$idActivite,
]);

if($reponse){
    header('location:profile.php?message=Vous avez rejoint l\'activité.&type=success');
    exit;
}else{
    header('location:activites.php?message=Erreur.');
}

?>