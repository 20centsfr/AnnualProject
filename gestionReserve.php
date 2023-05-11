<?php 
include ('includes/gestionDroits.php');
include ('includes/db.php');
include 'includes/header.php' ;

$idActivite = htmlspecialchars($_POST['idActivite']);

$select = $db->query("SELECT * FROM activite WHERE idActivite = ". $idActivite . "");
$content = $select->fetch();
?>

<br><br><br><br><br><br>
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <a href="admin_activites.php" class="link-dark"><h6>Retour aux activités</h6></a>
                    </div>
                    <h3 class="text-right">Modifier l'activité</h3>
                </div>
                <br><br>

                    <form enctype="multipart/form-data" action="gestionActivite.php" method="POST"> 
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Nom</label>
                                <input class="form-control" type="text" name="nom" placeholder="Nom" value="<?php echo $content['nomActivite']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Nombres de participants</label>
                                <input class="form-control" type="text" name="nbParticipants" placeholder="nbParticipants" value="<?php echo $content['nbParticipants']; ?>">
                            </div>
                        </div>
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Prix</label>
                                <input class="form-control" type="text" name="prix" placeholder="Prix" value="<?php echo $content['prix']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Horaire</label>
                                <input class="form-control" type="text" name="horaire" placeholder="Horaire" value="<?php echo $content['horaire']; ?>">
                            </div>
                        </div>
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Local</label>
                                <input class="form-control" type="text" name="local" placeholder="Local" value="<?php echo $content['localActivite']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Duree de l'activite</label>
                                <input class="form-control" type="text" name="duree" placeholder="Duree" value="<?php echo $content['dureeActivite']; ?>">
                            </div>
                        </div>
                        
                        <br><br><? include 'includes/message.php' ?><br><br>
                        <div class="d-flex justify-content-center">
                        <button type="submit" name="Modifier" class="btn btn-success" value="<?php echo $idActivite?>">Modifier</button>
                        </div>
                    </form> <br><br><br><br>
            </div>
        </div>
    </div>
</div>