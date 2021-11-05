const map = {

  init: function () {
   
    var posParis = [48.833, 2.333];
    // création de la map
    var myMap = L.map('map_enterprise').setView(posParis, 7);

    // création du calque images
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1Ijoib2dhZG9jIiwiYSI6ImNrdmRwa2RvMjB4cGcycW84amY1Y3ltbjEifQ.IvSprusFl7xvsGhuYEsk6g'
    }).addTo(myMap);


    map.dysplayMarker(myMap)


  },

  dysplayMarker: function (myMap) {
    // creation des marqueurs et popup
    
    
    let pointsList = [];
    for (let item of document.querySelectorAll('.list-group>li')) {
      // item est le noeud DOM d'un <li>
      var name = item.querySelector('#business_name')
      var nom = item.textContent;
      var geoloc = JSON.parse(item.dataset.geo);
      var marker = L.marker(geoloc).addTo(myMap).bindPopup(nom);
      marker.bindTooltip(name.textContent).openTooltip();
      pointsList.push(geoloc);
     
    }
    // réglage de la partie visible
    if (pointsList.length > 0)
    myMap.fitBounds(pointsList);
  }
}


// On lance la fonction init uniquement quand le DOM aura terminé de se lancer
document.addEventListener('DOMContentLoaded', map.init);