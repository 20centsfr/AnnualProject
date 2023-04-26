<?php 
include ('includes/gestionDroits.php');
include ('includes/db.php');
include 'includes/header.php' ;

$idFidelite = htmlspecialchars($_POST['idFidelite']);

$select = $db->query("SELECT * FROM fidelite WHERE idFidelite = ". $idFidelite . "");
$fidelite = $select->fetch();
?>

<br><br><br><br><br><br>
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <a href="admin_fidelite.php" class="link-dark"><h6>Retour aux offres de fidelité</h6></a>
                    </div>
                    <h3 class="text-right">Modifier l'offre</h3>
                </div>
                <br><br>

                    <form enctype="multipart/form-data" action="verifModifFidelite.php" method="POST"> 
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Nom</label>
                                <input class="form-control" type="text" name="nom" placeholder="Nom" value="<?php echo $fidelite['nomFidelite']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" placeholder="Description" value="<?php echo $fidelite['nbPlacesfidelite']; ?>">
                            </div>
                        </div>
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Nombre de points</label>
                                <input class="form-control" type="number" name="points" placeholder="points" value="<?php echo $fidelite['points']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Date de fin</label>
                                <input class="form-control" type="date" name="description" placeholder="date" value="<?php echo $fidelite['date']; ?>">
                            </div>
                        </div>
                        </div>
                        
                        <br><br><? include 'includes/message.php' ?><br><br>
                        <div class="d-flex justify-content-center">
                        <!--<button class="btn btn-primary profile-button" type="submit">Enregistrer les modifications</button>-->
                        <button type="submit" name="Modifier" class="btn btn-success" value="<?php echo $idFidelite?>">Modifier</button>
                        </div>
                    </form> <br><br><br><br>
            </div>
        </div>
    </div>
</div>

