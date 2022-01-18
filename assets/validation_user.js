
//Je selectionne mon input username
let formUsername = document.querySelector('#registration_form_username');
//ecouter la modification du nom de l utilisateur
formUsername.addEventListener('input', function(){
    validUsername(this);
});

//Je selectionne mon input email
let formEmail = document.querySelector('#registration_form_email');
//ecouter la modification de l email
formEmail.addEventListener('input', function(){
    validEmail(this);
});

//Je selectionne mon input password_first
let formPassword_first = document.querySelector('#registration_form_password_first');
//ecouter la modification de mon password
formPassword_first.addEventListener('input', function(){
   validpassword_first(this);
});

//Je selectionne mon input password_second
let formPassword_second = document.querySelector('#registration_form_password_second');
//ecouter la modification de mon password 2
formPassword_second.addEventListener('input', function(){
   validpassword_second(this);
});

// let submitForm = document.forms['registration_form'];
// submitForm.addEventListener('submit', function(e) {
//    e.preventDefault();
//    if (validUsername(formUsername)) {
//       console.log('username valide pour submit');
//       submitForm.submit();
//    }else{
//       console.log('username non valide pour submit');
//    }

// });



//************* Validation USERNAME *************




const validUsername = function(inputUsername){
    
   //je teste mon input Username avec ma regexp
 let testUsername = inputUsername.value.length > 3;
   
 
 


 if (testUsername) {

   //si le span est deja créé on le supprime
   if (inputUsername.nextElementSibling) {
      inputUsername.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputUsername.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Nom d\'utilisateur valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    formUsername.style.borderColor = 'green';
    return true;
     
 }
 else{

    //si le span est deja créé on le supprime
   if (inputUsername.nextElementSibling) {
    inputUsername.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputUsername.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Nom d\'utilisateur doit contenir 4 caractere minimum';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    formUsername.style.borderColor = 'red';
    return false;
 }

};



//************* Validation EMAIL *************



const validEmail = function(inputEmail){

   //je met en place ma regexp
 let emailRegexp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$', 'g');
   //je teste mon input Email avec ma regexp
 let testEmail = emailRegexp.test(inputEmail.value);

 if (testEmail) {

   //si le span est deja créé on le supprime
   if (inputEmail.nextElementSibling) {
      inputEmail.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputEmail.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Email valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    formEmail.style.borderColor = 'green';
     return true;
 }
 else{

    //si le span est deja créé on le supprime
   if (inputEmail.nextElementSibling) {
    inputEmail.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputEmail.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Email invalide';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    formEmail.style.borderColor = 'red';
    return false;
 }

};

 //************* Validation PASSWORD *************


 


const validpassword_first = function(inputPassword_first){

   let msg;
   let valid = false;
   //Au moins 8 caracteres
   if (inputPassword_first.value.length < 8) {
      msg = 'Le mot de passe doit contenir au moins 8 caracteres';
   }
   else if
   //Au moins 1 maj
      (!/[A-Z]/.test(inputPassword_first.value)){
      msg = 'Le mot de passe doit contenir au moins 1 majuscule';
      }
   //Au moins 1 min   
   else if    
   (!/[a-z]/.test(inputPassword_first.value)) {
      msg = 'Le mot de passe doit contenir au moins 1 minuscule';
   }
   //Au moins 1 caractere special
   else if
   (!/[@$!%*#?&-\/]/.test(inputPassword_first.value)) {
      msg = 'Le mot de passe doit contenir au moins 1 caractere special';
   }
   //Mot de passe valide
   else {
      msg = 'Le mot de passe est Valide';
      valid = true;
   }

   

   if (valid) {
   //si le span est deja créé on le supprime
   if (inputPassword_first.nextElementSibling) {
      inputPassword_first.nextElementSibling.remove();
     } 
     
     let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPassword_first.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Mot de passe Valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    formPassword_first.style.borderColor = 'green';
     
 }
 else {

    //si le span est deja créé on le supprime
   if (inputPassword_first.nextElementSibling) {
    inputPassword_first.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPassword_first.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = msg;
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    formPassword_first.style.borderColor = 'red';
 
 }};



 //************* Validation PASSWORD 2 *************

 const validpassword_second = function(inputPassword_second){
   //si les deux password sont identique
   if (formPassword_first.value == inputPassword_second.value) {

   //si le span est deja créé on le supprime
   if (inputPassword_second.nextElementSibling) {
      inputPassword_second.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPassword_second.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Mot de passe identique';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    inputPassword_second.style.borderColor = 'green';
     return true;
 }
  else{

    //si le span est deja créé on le supprime
   if (inputPassword_second.nextElementSibling) {
    inputPassword_second.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPassword_second.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Mot de passe incorrect';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    inputPassword_second.style.borderColor = 'red';
    return false;
  }

 };