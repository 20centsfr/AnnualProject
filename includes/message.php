<div class="error">
    <?php 
    if(isset($_GET['message']) && !empty($_GET['message'])){
        $error = htmlspecialchars($_GET['type']);
        $message = htmlspecialchars($_GET['message']);
        if($error == 'success'){
        echo '<div class="alert alert-success alert-message " role="alert">' . $message . '</div>';
        }
        else{
        echo '<div class="alert alert-danger alert-message" role="alert">' . $message . '</div>';
        }
    }
    ?>
</div>