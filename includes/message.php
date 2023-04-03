<div class="error">
    <?php 
    if(isset($_GET['message']) && !empty($_GET['message'])){
        $error = htmlspecialchars($_GET['message']);
        if($error == 'Compte créé avec succès' || $error == 'Informations modifiées avec succès'){
        echo '<div class="alert alert-success" role="alert">' . $error . '</div>';
        }
        else{
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
    }
    ?>
</div>