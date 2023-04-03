import { 
    FATAL_EXCEPTION, MYSQL_EXCEPTION, INVALID_AUTH_ACTIVITE, ALREADY_IN_CART, NOT_IN_CART 
} from 'scripts/const.js';

function addToCart(productNumber) {
    const activite = localStorage.getItem("activite");
    const id = document.getElementById("shop-item-id" + productNumber);
    const tarifActivite = id.innerHTML; // id tarif
    const serializedInput = JSON.stringify({ "activite": activite, "idActivite": tarifActivite, "change": 1 });

    try {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/order/change", false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                const response = this.responseText;
                const parsedResponse = JSON.parse(response);
                if (parsedResponse.success === true) {
                    window.alert("Ajouté au panier.");
                } else {
                    switch (parsedResponse.errorCode) {
                        case FATAL_EXCEPTION: 
                            console.log("Erreur fatale. Veuillez réessayer."); break;
                        case MYSQL_EXCEPTION: 
                            console.log("Erreur base de données. Veuillez réessayer."); break;
                        case INVALID_AUTH_ACTIVITE: 
                            console.log("activite invalide."); break;
                        case ALREADY_IN_CART: 
                            console.log("Déjà dans le panier."); break;
                        case NOT_IN_CART: 
                            console.log("Pas dans le panier."); break;
                        default: 
                            console.log("Erreur inconnue."); break;
                    }
                }
            }
        };
        xhttp.send(serializedInput);
    } catch (error) {
        console.error(error);
    }
}

export { addToCart }