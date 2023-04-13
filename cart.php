<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include("includes/header.php"); 
        include ('includes/connected.php');?>
        
        <script>
            function changeQuantity(cartItem, action) {
                const activite = localStorage.getItem("activite");
                const id = document.getElementById("idCart" + cartItem).innerHTML;
                const idValue = id.replace('ID: ', '');
                const serializedInput = JSON.stringify({ 
                    "activite": activite, 
                    "idActivite": idValue, 
                    "change": action 
                });
                try {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "/order/change", false);
                    xhttp.setRequestHeader("Content-Type", "application/json");
                    xhttp.onreadystatechange = function () {
                        if (this.readyState === 4) {
                            const response = this.responseText;
                            const parsedResponse = JSON.parse(response);
                            if (parsedResponse.success === true) {
                                const quantity = document.getElementById("quantite" + cartItem);
                                let quantityValue;
                                quantityValue = parseInt(quantity.innerHTML.replace('x', ''));
                                if(action == 1) {
                                    quantityValue += 1; 
                                } else {
                                    quantityValue -= 1;
                                }
                                quantity.innerHTML = quantityValue + 'x';
                            } else {
                                switch (parsedResponse.errorCode) {
                                    case FATAL_EXCEPTION: 
                                        console.log("Erreur fatale. Veuillez réessayer."); 
                                        break;
                                    case MYSQL_EXCEPTION: 
                                        console.log("Erreur base de données. Veuillez réessayer."); 
                                        break;
                                    case INVALID_PARAMETER: 
                                        console.log("Paramètre invalide."); 
                                        break;
                                    case MISSING_PARAMETER: 
                                        console.log("Paramètre manquant."); 
                                        break;
                                    case PARAMETER_WRONG_LENGTH: 
                                        console.log("Paramètre de longueur invalide."); 
                                        break;
                                    case USER_NOT_FOUND: 
                                        console.log("Utilisateur inexistant."); 
                                        break;
                                    case INCORRECT_USER_CREDENTIALS: 
                                        console.log("Identifiants invalides."); 
                                        break;
                                    case INVALID_AUTH_ACTIVITE: 
                                        console.log("activite invalide."); 
                                        break;
                                    default: 
                                    console.log("Uknown error."); 
                                    break;
                                }
                            }
                        }
                    };
                    xhttp.send(serializedInput);
                } catch (error) {
                    console.error(error);
                }
            }
        </script>
    </head>
    <body>
        <main>
        <?php include("includes/nav.php"); ?>
        <section class="container">
            <div class="separator-l"></div>
            <div class="container cart-container">
                <div class="row">
                    <p class="title">Panier</p>
                    <div class="separator-s"></div>
                    <img src="assets/img/icons/cart.png" alt="Catalogue des activités" height="100px" />
                </div>
                <div class="separator-m"></div>
                <div id="cart-full"></div>
                <div id="cart-empty">
                    <div class="row"><p class="shop-item-name">Panier vide.</p></div>
                </div>
            </div>

            <div class="separator-l"></div>
        </section>
        </main>

        <footer>
            <?php include("includes/footer.php"); ?>
        </footer>
        <script type="module" src="scripts/cart.js"></script>
    </body>
</html>