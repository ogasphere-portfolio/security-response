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

    // ajout d'un markeur
    // todo récuperer les données longitude et lattitude dans le ul du template  pour afficher les marqueurs
    var listPos=document.querySelectorAll('list-group-item');
    console.log(listPos);
    for(var i = 0; i < listPos.length; i++)
      {
        
      var li= listPos[i].innerHTML();
      
      }

    var marker = L.marker([48.833, 2.333]).addTo(map);



    // add popup
    marker.bindPopup('<h3> Paris, France. </h3>');

    }
  }


// On lance la fonction init uniquement quand le DOM aura terminé de se lancer
document.addEventListener('DOMContentLoaded', app.init);
