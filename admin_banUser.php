<?php //todo



$idUser = $_POST['idUser'];

$q = "UPDATE user SET banned = 1 WHERE idUser = :idUser";
$req = $db->prepare($q);
$req->execute([ 'idUser'=>$idUser ]);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>