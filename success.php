<?php
  if(!empty($_GET['tid'] && !empty($_GET['product']))) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $tid = $GET['tid'];
    $product = $GET['product'];
  } else {
    header('Location: paiement.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Merci de votre achat</title>
</head>
<body>
  <div class="container mt-4">
    <h2>Merci de votre achat <?php echo $product; ?></h2>
    <hr>
    <p>Contactez nous pour plus d'information sur les paiements de lupum.ddns.net</p>
    <p><a href="index.php" class="btn btn-light mt-2">Retourner en arrière</a></p>
  </div>
</body>
</html>