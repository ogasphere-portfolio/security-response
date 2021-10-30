var ny = [40.741895, -73.989308];
// création de la map
var map = L.map('map_enterprise').setView([48.833, 2.333], 7); 

// création du calque images
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoib2dhZG9jIiwiYSI6ImNrdmRwa2RvMjB4cGcycW84amY1Y3ltbjEifQ.IvSprusFl7xvsGhuYEsk6g'
}).addTo(map);

// ajout d'un markeur
var marker = L.marker([48.833, 2.333]).addTo(map);
// ajout d'un popup
marker.bindPopup('<h3> Paris, France. </h3>');