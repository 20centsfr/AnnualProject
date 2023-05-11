<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="leaflet/leaflet.css" />
        <script src="leaflet/leaflet.js"></script>
        <style type="text/css">
            #map { 
                height: 400px;
                weight: 400px;
            }
        </style>
        <title>Carte</title>
    </head>
    <body>
    <div id="map"> </div>

        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	    <script type="text/javascript">
            // latitude et longitude de Paris 
            var lat = 48.852969;
            var lon = 2.349903;
            var macarte = null;
            
            var villes = {
                "Erard": { "lat": 48.84617986513242, "lon": 2.385539456879536 },
                "Nation2": { "lat": 48.849233699362685, "lon": 2.3871283839987902 },
                "Nation1": { "lat": 48.84923675170712, "lon": 2.3896483684877508}
            };

            function initMap() {
                var iconBase = 'http://localhost/assets/img/';
                // objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
                for (ville in villes) {
                    var myIcon = L.icon({
                        iconUrl: iconBase + "point.png",
                        iconSize: [60, 60],
                        iconAnchor: [25, 50],
                        popupAnchor: [-3, -76],
                    });
                    var marker = L.marker([villes[ville].lat, villes[ville].lon], { icon: myIcon }).addTo(macarte);
                    marker.bindPopup(ville);
                }               	
            }
            window.onload = function(){
		initMap(); 
            };
        </script>
    </body>
</html>