const app = {

  init: function () {
    console.log('app.init');


    var posParis = [48.833, 2.333];
    // création de la map
    var map = L.map('map_enterprise').setView(posParis, 7);

    // création du calque images
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1Ijoib2dhZG9jIiwiYSI6ImNrdmRwa2RvMjB4cGcycW84amY1Y3ltbjEifQ.IvSprusFl7xvsGhuYEsk6g'
    }).addTo(map);


    app.dysplayMarker(map)


  },

  dysplayMarker: function (map) {
    // creation des marqueurs et popup
    let pointsList = [];
    for (let item of document.querySelectorAll('.list-group>li')) {
      // item est le noeud DOM d'un <li>
      let nom = item.textContent;
      let geoloc = JSON.parse(item.dataset.geo);
      var marker = L.marker(geoloc).addTo(map).bindPopup(nom);
      pointsList.push(geoloc);
      console.log(nom);

    }
    // réglage de la partie visible
    if (pointsList.length > 0)
      map.fitBounds(pointsList);
  }
}


// On lance la fonction init uniquement quand le DOM aura terminé de se lancer
document.addEventListener('DOMContentLoaded', app.init);