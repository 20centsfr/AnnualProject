<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'includes/header.php' ;
include 'includes/nav.php';
include ('includes/connected.php');
include "includes/userInfo.php";

?>

<br><br><br><br><br><br>
<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <a href="profile.php" class="link-dark"><h6>Retour au profil</h6></a>
                    </div>
                    <h3 class="text-right">Modifier mes informations personnelles</h3>
                </div>
                <br><br>

                    <form enctype="multipart/form-data" action="verifModifProfil.php" method="POST"> 
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Prenom</label>
                                <input class="form-control" type="text" name="prenom" placeholder="Prenom" value="<?php echo $userInfo['prenom']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Nom</label>
                                <input class="form-control" type="text" name="nom" placeholder="Nom" value="<?php echo $userInfo['nom']; ?>">
                            </div>
                        </div>
                        <div class="row mt-2">         
                            <div class="col-md-6">
                                <label>Entreprise</label>
                                <input class="form-control" type="text" name="entreprise" placeholder="Entreprise" value="<?php echo $userInfo['entreprise']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $userInfo['email']; ?>">
                            </div>
                        </div><br><br><? include 'includes/message.php' ?><br><br>
                        <div class="d-flex justify-content-center">
                        <!--<button class="btn btn-primary profile-button" type="submit">Enregistrer les modifications</button>-->
                        <button type="submit" name="Modifier" class="btn btn-success">Modifier</button>
                        </div>
                    </form> <br><br><br><br>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
