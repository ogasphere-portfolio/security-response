document.addEventListener('DOMContentLoaded', () => {
  const eyes = document.querySelectorAll(".fa-eye-slash");

  // Je transforme ma nodelist en array pour les utiliser dans une boucle
  // Je boucle et j'ajoute un addEventListener sur chacun des éléments
  // Au clique j'exécute la méthode changeEye qui utilisera l'élément ciblé
  for (let index = 0; index < eyes.length; index++) {
    const element = [...eyes][index];
    element.addEventListener('click', () => {
      changeEye(element)
    });
  }

  // ChangeEye est la méthode qui permet de modifier les classes de l'élément
  // elle change également le password type correspondant
  // je sélectionne le parent précédent de mon élément (la div contenant le label et l'input)
  // et ensuite je choisi l'enfant qui correspond à l'input
  // j'utilise ensuite la méthode toggle que me permet d'ajouter ou d'enlever la classe en fonction
  // de si elle existe ou pas
  const changeEye = (element) => { 
    console.log(password)   
    let password = element.previousElementSibling.children[1];
    element.classList.toggle('fa-eye-slash')
    element.classList.toggle('fa-eye')

    if (element.classList.contains("fa-eye-slash")) {
      password.type = "password";
    } else {      
      password.type = 'text';
    }
  }
});