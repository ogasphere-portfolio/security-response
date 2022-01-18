// //Je selectionne mon input business name
// let formGender = document.querySelector('#registration_form_userMember_gender');
// let formGenderMister = document.querySelector('#registration_form_userMember_gender_0');
// let formGenderMiss = document.querySelector('#registration_form_userMember_gender_1');
// //ecouter la modification du nom de l utilisateur
// formGender.addEventListener('change', function(){
//     validformGender(this);
// });

//Je selectionne mon input firstname
let formFirstName = document.querySelector('#registration_form_userMember_firstname');
//ecouter la modification du nom de l utilisateur
if (formFirstName) {
formFirstName.addEventListener('input', function(){
    validFirstName(this);
});}

//Je selectionne mon input lastname
let formLastName = document.querySelector('#registration_form_userMember_lastname');
//ecouter la modification du nom de l utilisateur
if (formLastName) {
formLastName.addEventListener('input', function(){
    validLastName(this);
})};

//Je selectionne mon input lastname
let formDescription = document.querySelector('#registration_form_userMember_description');
//ecouter la modification du nom de l utilisateur
if (formDescription) {
formDescription.addEventListener('input', function(){
    validDescription(this);
});}

//Je selectionne mon input city
let formCityMember = document.querySelector('#registration_form_userMember_city');
//ecouter la modification du nom de l utilisateur
if (formCityMember) {
formCityMember.addEventListener('input', function(){
    validCityMember(this);
});}


// //************* Validation GENDER *************

// const validformGender = function(inputGender){
//     console.log(formGenderMister.checked == true);
//     //je teste mon input Username avec ma regexp
 
 
//   if (formGenderMister.checked == true) {
//     console.log('je suis mister');
//     //si le span est deja créé on le supprime
//     if (inputGender.nextElementSibling) {
//        inputGender.nextElementSibling.remove();
//       } 
 
//      let span = document.createElement('span');
     
//     //j ajoute le span apres mon input
//     inputGender.insertAdjacentElement('afterend', span);
    
//     //on ajoute le text dans le span
//      span.innerHTML = 'Nom d\'entreprise valide';
//      //on remove la classe
//      span.classList.remove('text-danger');
//      //on ajoute le classe
//      span.classList.add('text-success');
//      //on ajoute un border color
//      formGender.style.borderColor = 'green';
//      return true;
      
//   }
//   else {
      
  
//       console.log('je suis miss');
 
//      //si le span est deja créé on le supprime
//     if (inputGender.nextElementSibling) {
//      inputGender.nextElementSibling.remove();
//     } 
 
//      let span = document.createElement('span');
     
//     //j ajoute le span apres mon input
//     inputGender.insertAdjacentElement('afterend', span);
    
//     //on ajoute le text dans le span
//      span.innerHTML = 'Nom d\'entreprise doit contenir 4 caractere minimum';
//      //on remove la classe
//      span.classList.remove('text-success');
//      //on ajoute le classe
//      span.classList.add('text-danger');
//      //on ajoute un border color
//      inputGender.style.borderColor = 'red';
//      return false;
//   }
  
//  };


//************* Validation FIRSTNAME *************

const validFirstName = function(inputFirstName){
    
    //je teste mon input FirstName avec ma regexp
  let testFirstName = inputFirstName.value.length > 3;
    
  if (testFirstName) {
 
    //si le span est deja créé on le supprime
    if (inputFirstName.nextElementSibling) {
       inputFirstName.nextElementSibling.remove();
      } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputFirstName.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Prénom valide';
     //on remove la classe
     span.classList.remove('text-danger');
     //on ajoute le classe
     span.classList.add('text-success');
     //on ajoute un border color
     formFirstName.style.borderColor = 'green';
     return true;
      
  }
  else{
 
     //si le span est deja créé on le supprime
    if (inputFirstName.nextElementSibling) {
     inputFirstName.nextElementSibling.remove();
    } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputFirstName.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Prénom doit contenir 4 caractere minimum';
     //on remove la classe
     span.classList.remove('text-success');
     //on ajoute le classe
     span.classList.add('text-danger');
     //on ajoute un border color
     formFirstName.style.borderColor = 'red';
     return false;
  }
 
 };


 //************* Validation LASTNAME *************

const validLastName = function(inputLastName){
    
    //je teste mon input LastName avec ma regexp
  let testLastName = inputLastName.value.length > 3;
    
  if (testLastName) {
 
    //si le span est deja créé on le supprime
    if (inputLastName.nextElementSibling) {
       inputLastName.nextElementSibling.remove();
      } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputLastName.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Nom valide';
     //on remove la classe
     span.classList.remove('text-danger');
     //on ajoute le classe
     span.classList.add('text-success');
     //on ajoute un border color
     formLastName.style.borderColor = 'green';
     return true;
      
  }
  else{
 
     //si le span est deja créé on le supprime
    if (inputLastName.nextElementSibling) {
     inputLastName.nextElementSibling.remove();
    } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputLastName.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Nom doit contenir 4 caractere minimum';
     //on remove la classe
     span.classList.remove('text-success');
     //on ajoute le classe
     span.classList.add('text-danger');
     //on ajoute un border color
     formLastName.style.borderColor = 'red';
     return false;
  }
 
 };


 //************* Validation DESCRIPTION *************

const validDescription = function(inputDescription){
    
    //je teste mon input Description avec ma regexp
  let testDescription = inputDescription.value.length > 3;
    
  if (testDescription) {
 
    //si le span est deja créé on le supprime
    if (inputDescription.nextElementSibling) {
       inputDescription.nextElementSibling.remove();
      } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputDescription.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Description valide';
     //on remove la classe
     span.classList.remove('text-danger');
     //on ajoute le classe
     span.classList.add('text-success');
     //on ajoute un border color
     formDescription.style.borderColor = 'green';
     return true;
      
  }
  else{
 
     //si le span est deja créé on le supprime
    if (inputDescription.nextElementSibling) {
     inputDescription.nextElementSibling.remove();
    } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputDescription.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Description doit contenir 4 caractere minimum';
     //on remove la classe
     span.classList.remove('text-success');
     //on ajoute le classe
     span.classList.add('text-danger');
     //on ajoute un border color
     formDescription.style.borderColor = 'red';
     return false;
  }
 
 };


 //************* Validation CITY MEMBER *************

const validCityMember = function(inputCityMember){
    
    //je teste mon input CityMember avec ma regexp
  let testCityMember = inputCityMember.value.length > 3;
    
  if (testCityMember) {
 
    //si le span est deja créé on le supprime
    if (inputCityMember.nextElementSibling) {
       inputCityMember.nextElementSibling.remove();
      } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputCityMember.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Ville valide';
     //on remove la classe
     span.classList.remove('text-danger');
     //on ajoute le classe
     span.classList.add('text-success');
     //on ajoute un border color
     formCityMember.style.borderColor = 'green';
     return true;
      
  }
  else{
 
     //si le span est deja créé on le supprime
    if (inputCityMember.nextElementSibling) {
     inputCityMember.nextElementSibling.remove();
    } 
 
     let span = document.createElement('span');
     
    //j ajoute le span apres mon input
    inputCityMember.insertAdjacentElement('afterend', span);
    
    //on ajoute le text dans le span
     span.innerHTML = 'Ville invalide';
     //on remove la classe
     span.classList.remove('text-success');
     //on ajoute le classe
     span.classList.add('text-danger');
     //on ajoute un border color
     formCityMember.style.borderColor = 'red';
     return false;
  }
 
 };


 