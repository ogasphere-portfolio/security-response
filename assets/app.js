
import './styles/app.scss';
import Alert from 'bootstrap/js/dist/alert';
// start the Stimulus application
import './bootstrap';


const app = {


    init: function () {
       
     
    }
  }
  
  
  // On lance la fonction init uniquement quand le DOM aura terminé de se lancer
  document.addEventListener('DOMContentLoaded', app.init);
// any CSS you import will output into a single css file (app.css in this case)
