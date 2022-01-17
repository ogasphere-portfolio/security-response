//Je selectionne mon input business name
let formBusinessNameCompany = document.querySelector('#registration_form_userCompany_business_name');
//ecouter la modification du nom de l utilisateur
if (formBusinessNameCompany) {
formBusinessNameCompany.addEventListener('input', function(){
    validformBusinessNameCompany(this);
});}

//Je selectionne mon input adress
let formAdressCompany = document.querySelector('#registration_form_userCompany_address');
//ecouter la modification du numero de siret
if (formAdressCompany) {
   formAdressCompany.addEventListener('input', function(){
       validformAdressCompany(this);
   });}

//Je selectionne mon input zip code
let formZipCodeCompany = document.querySelector('#registration_form_userCompany_zip_code');
//ecouter la modification du numero de siret
if (formZipCodeCompany) {
   formZipCodeCompany.addEventListener('input', function(){
       validformZipCodeCompany(this);
   });}

//Je selectionne mon input city
let formCityCompany = document.querySelector('#registration_form_userCompany_city');
//ecouter la modification du numero de siret
if (formCityCompany) {
   formCityCompany.addEventListener('input', function(){
       validformCityCompany(this);
   });}

//Je selectionne mon input phone
let formPhoneCompany = document.querySelector('#registration_form_userCompany_phone_number');
//ecouter la modification du numero de siret
if (formPhoneCompany) {
   formPhoneCompany.addEventListener('input', function(){
       validformPhoneCompany(this);
   });}

//Je selectionne mon input contact mail
let formContactMailCompany = document.querySelector('#registration_form_userCompany_contact_mail');
//ecouter la modification du numero de siret
if (formContactMailCompany) {
   formContactMailCompany.addEventListener('input', function(){
       validformContactMailCompany(this);
   });}



//************* Validation BUSINESS NAME COMPANY *************




const validformBusinessNameCompany = function(inputBusinessNameCompany){
    
   //je teste mon input Username avec ma regexp
 let testBusinessNameCompany= inputBusinessNameCompany.value.length > 3;


 if (testBusinessNameCompany) {

   //si le span est deja créé on le supprime
   if (inputBusinessNameCompany.nextElementSibling) {
      inputBusinessNameCompany.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputBusinessNameCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Nom d\'entreprise valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    inputBusinessNameCompany.style.borderColor = 'green';
    return true;
     
 }
 else{

    //si le span est deja créé on le supprime
   if (inputBusinessNameCompany.nextElementSibling) {
    inputBusinessNameCompany.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputBusinessNameCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Nom d\'entreprise doit contenir 4 caractere minimum';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    inputBusinessNameCompany.style.borderColor = 'red';
    return false;
 }
 
};



//************* Validation ADRESS *************




const validformAdressCompany = function(inputAdressCompany){
    
   //je teste mon input siret number avec ma regexp
   let testAdressCompany = inputAdressCompany.value.length > 4;
 
   if (testAdressCompany) {
 
     //si le span est deja créé on le supprime
     if (inputAdressCompany.nextElementSibling) {
        inputAdressCompany.nextElementSibling.remove();
       } 
  
      let span = document.createElement('span');
      
     //j ajoute le span apres mon input
     inputAdressCompany.insertAdjacentElement('afterend', span);
     
     //on ajoute le text dans le span
      span.innerHTML = 'Adress valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputAdressCompany.style.borderColor = 'green';
      return true;
       
   }
   else{
  
      //si le span est deja créé on le supprime
     if (inputAdressCompany.nextElementSibling) {
      inputAdressCompany.nextElementSibling.remove();
     } 
  
      let span = document.createElement('span');
      
     //j ajoute le span apres mon input
     inputAdressCompany.insertAdjacentElement('afterend', span);
     
     //on ajoute le text dans le span
      span.innerHTML = 'Adress invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputAdressCompany.style.borderColor = 'red';
      return false;
   }};


   //************* Validation ZIP CODE *************




  const validformZipCodeCompany = function(inputZipCodeCompany){
    
   //je met en place ma regexp
 let ZipCodeCompanyRegexp= new RegExp('^[0-9]+$');

 //je teste mon input siret number avec ma regexp
 let testZipCodeCompany = ZipCodeCompanyRegexp.test(inputZipCodeCompany.value);

 if (testZipCodeCompany) {

   //si le span est deja créé on le supprime
   if (inputZipCodeCompany.nextElementSibling) {
      inputZipCodeCompany.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputZipCodeCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Code postal valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    inputZipCodeCompany.style.borderColor = 'green';
    return true;
     
 }
 else{

    //si le span est deja créé on le supprime
   if (inputZipCodeCompany.nextElementSibling) {
    inputZipCodeCompany.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputZipCodeCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Code postal invalide';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    inputZipCodeCompany.style.borderColor = 'red';
    return false;
 }};


 //************* Validation CITY *************




 const validformCityCompany = function(inputCityCompany){
    
   //je met en place ma regexp
 let CityCompanyRegexp= new RegExp('^[a-zA-Z]+$');

 //je teste mon input siret number avec ma regexp
 let testCityCompany = CityCompanyRegexp.test(inputCityCompany.value);

 if (testCityCompany) {

   //si le span est deja créé on le supprime
   if (inputCityCompany.nextElementSibling) {
      inputCityCompany.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputCityCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Ville valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    inputCityCompany.style.borderColor = 'green';
    return true;
     
 }
 else{

    //si le span est deja créé on le supprime
   if (inputCityCompany.nextElementSibling) {
    inputCityCompany.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputCityCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Ville invalide';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    inputCityCompany.style.borderColor = 'red';
    return false;
 }};


 //************* Validation PHONE *************




const validformPhoneCompany = function(inputPhoneCompany){
    
   //je met en place ma regexp
 let PhoneCompanyRegexp= new RegExp('^[0-9]+$');

 //je teste mon input siret number avec ma regexp
 let testPhoneCompany = PhoneCompanyRegexp.test(inputPhoneCompany.value);

 if (testPhoneCompany) {

   //si le span est deja créé on le supprime
   if (inputPhoneCompany.nextElementSibling) {
      inputPhoneCompany.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPhoneCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Numéro de téléphone valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    inputPhoneCompany.style.borderColor = 'green';
    return true;
     
 }
 else{

    //si le span est deja créé on le supprime
   if (inputPhoneCompany.nextElementSibling) {
    inputPhoneCompany.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputPhoneCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Numéro de téléphone invalide';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    inputPhoneCompany.style.borderColor = 'red';
    return false;
 }};


 //************* Validation CONTACT MAIL *************



const validformContactMailCompany = function(inputContactMailCompany){

   //je met en place ma regexp
 let ContactMailCompanyRegexp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$', 'g');
   //je teste mon input ContactMailCompany avec ma regexp
 let testContactMailCompany = ContactMailCompanyRegexp.test(inputContactMailCompany.value);

 if (testContactMailCompany) {

   //si le span est deja créé on le supprime
   if (inputContactMailCompany.nextElementSibling) {
      inputContactMailCompany.nextElementSibling.remove();
     } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputContactMailCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Mail de contact valide';
    //on remove la classe
    span.classList.remove('text-danger');
    //on ajoute le classe
    span.classList.add('text-success');
    //on ajoute un border color
    formContactMailCompany.style.borderColor = 'green';
     return true;
 }
 else{

    //si le span est deja créé on le supprime
   if (inputContactMailCompany.nextElementSibling) {
    inputContactMailCompany.nextElementSibling.remove();
   } 

    let span = document.createElement('span');
    
   //j ajoute le span apres mon input
   inputContactMailCompany.insertAdjacentElement('afterend', span);
   
   //on ajoute le text dans le span
    span.innerHTML = 'Mail de contact invalide';
    //on remove la classe
    span.classList.remove('text-success');
    //on ajoute le classe
    span.classList.add('text-danger');
    //on ajoute un border color
    formContactMailCompany.style.borderColor = 'red';
    return false;
 }

};