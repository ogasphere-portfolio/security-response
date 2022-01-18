//Je selectionne mon input business name
let formBusinessName = document.querySelector('#registration_form_userEnterprise_business_name');
//ecouter la modification du nom de l utilisateur
if (formBusinessName) {
   formBusinessName.addEventListener('input', function () {
      validformBusinessName(this);
   });
}


//Je selectionne mon input siret number
let formSiretNumber = document.querySelector('#registration_form_userEnterprise_siret_number');
//ecouter la modification du numero de siret
if (formSiretNumber) {
   formSiretNumber.addEventListener('input', function () {
      validformSiretNumber(this);
   });
}


//Je selectionne mon input adress
let formAdress = document.querySelector('#registration_form_userEnterprise_address');
//ecouter la modification du numero de siret
if (formAdress) {
   formAdress.addEventListener('input', function () {
      validformAdress(this);
   });
}


//Je selectionne mon input zip code
let formZipCode = document.querySelector('#registration_form_userEnterprise_zip_code');
//ecouter la modification du numero de siret
if (formZipCode) {
   formZipCode.addEventListener('input', function () {
      validformZipCode(this);
   });
}


//Je selectionne mon input city
let formCity = document.querySelector('#registration_form_userEnterprise_city');
//ecouter la modification du numero de siret
if (formCity) {
   formCity.addEventListener('input', function () {
      validformCity(this);
   });
}

//Je selectionne mon input phone
let formPhone = document.querySelector('#registration_form_userEnterprise_phone_number');
//ecouter la modification du numero de siret
if (formPhone) {
   formPhone.addEventListener('input', function () {
      validformPhone(this);
   });
}

//Je selectionne mon input contact mail
let formContactMail = document.querySelector('#registration_form_userEnterprise_contact_mail');
//ecouter la modification du numero de siret
if (formContactMail) {
   formContactMail.addEventListener('input', function () {
      validformContactMail(this);
   });
}



//************* Validation BUSINESS NAME *************




const validformBusinessName = function (inputBusinessName) {

   //je teste mon input Username avec ma regexp
   let testBusinessName = inputBusinessName.value.length > 3;


   if (testBusinessName) {

      //si le span est deja créé on le supprime
      if (inputBusinessName.nextElementSibling) {
         inputBusinessName.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputBusinessName.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Nom d\'entreprise valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputBusinessName.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputBusinessName.nextElementSibling) {
         inputBusinessName.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputBusinessName.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Nom d\'entreprise doit contenir 4 caractere minimum';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputBusinessName.style.borderColor = 'red';
      return false;
   }

};


//************* Validation SIRET NUMBER *************




const validformSiretNumber = function (inputSiretNumber) {

   //je met en place ma regexp
   let siretNumberRegexp = new RegExp('^[0-9]+$');

   //je teste mon input siret number avec ma regexp
   let testSiretNumber = siretNumberRegexp.test(inputSiretNumber.value);

   if (testSiretNumber) {

      //si le span est deja créé on le supprime
      if (inputSiretNumber.nextElementSibling) {
         inputSiretNumber.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputSiretNumber.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Numero de siret valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputSiretNumber.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputSiretNumber.nextElementSibling) {
         inputSiretNumber.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputSiretNumber.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Numero de siret invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputSiretNumber.style.borderColor = 'red';
      return false;
   }
};



//************* Validation ADRESS *************




const validformAdress = function (inputAdress) {

   //je teste mon input siret number avec ma regexp
   let testAdress = inputAdress.value.length > 4;

   if (testAdress) {

      //si le span est deja créé on le supprime
      if (inputAdress.nextElementSibling) {
         inputAdress.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputAdress.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Adresse valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputAdress.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputAdress.nextElementSibling) {
         inputAdress.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputAdress.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Adresse invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputAdress.style.borderColor = 'red';
      return false;
   }
};



//************* Validation ZIP CODE *************




const validformZipCode = function (inputZipCode) {

   //je met en place ma regexp
   let ZipCodeRegexp = new RegExp('^[0-9]+$');

   //je teste mon input siret number avec ma regexp
   let testZipCode = ZipCodeRegexp.test(inputZipCode.value);

   if (testZipCode) {

      //si le span est deja créé on le supprime
      if (inputZipCode.nextElementSibling) {
         inputZipCode.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputZipCode.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Code postal valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputZipCode.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputZipCode.nextElementSibling) {
         inputZipCode.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputZipCode.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Code postal invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputZipCode.style.borderColor = 'red';
      return false;
   }
};



//************* Validation CITY *************




const validformCity = function (inputCity) {

   //je met en place ma regexp
   let CityRegexp = new RegExp('^[a-zA-Zéèùû ]+$');

   //je teste mon input siret number avec ma regexp
   let testCity = CityRegexp.test(inputCity.value);

   if (testCity) {

      //si le span est deja créé on le supprime
      if (inputCity.nextElementSibling) {
         inputCity.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputCity.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Ville valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputCity.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputCity.nextElementSibling) {
         inputCity.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputCity.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Ville invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputCity.style.borderColor = 'red';
      return false;
   }
};



//************* Validation PHONE *************




const validformPhone = function (inputPhone) {

   //je met en place ma regexp
   let PhoneRegexp = new RegExp('^[0-9]+$');

   //je teste mon input siret number avec ma regexp
   let testPhone = PhoneRegexp.test(inputPhone.value);

   if (testPhone) {

      //si le span est deja créé on le supprime
      if (inputPhone.nextElementSibling) {
         inputPhone.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputPhone.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Numéro de téléphone valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      inputPhone.style.borderColor = 'green';
      return true;

   } else {

      //si le span est deja créé on le supprime
      if (inputPhone.nextElementSibling) {
         inputPhone.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputPhone.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Numéro de téléphone invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      inputPhone.style.borderColor = 'red';
      return false;
   }
};


//************* Validation CONTACT MAIL *************



const validformContactMail = function (inputContactMail) {

   //je met en place ma regexp
   let ContactMailRegexp = new RegExp('^[a-zA-Z0-9.-_]+[@]{1}[a-zA-Z0-9.-_]+[.]{1}[a-z]{2,10}$', 'g');
   //je teste mon input ContactMail avec ma regexp
   let testContactMail = ContactMailRegexp.test(inputContactMail.value);

   if (testContactMail) {

      //si le span est deja créé on le supprime
      if (inputContactMail.nextElementSibling) {
         inputContactMail.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputContactMail.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Mail de contact valide';
      //on remove la classe
      span.classList.remove('text-danger');
      //on ajoute le classe
      span.classList.add('text-success');
      //on ajoute un border color
      formContactMail.style.borderColor = 'green';
      return true;
   } else {

      //si le span est deja créé on le supprime
      if (inputContactMail.nextElementSibling) {
         inputContactMail.nextElementSibling.remove();
      }

      let span = document.createElement('span');

      //j ajoute le span apres mon input
      inputContactMail.insertAdjacentElement('afterend', span);

      //on ajoute le text dans le span
      span.innerHTML = 'Mail de contact invalide';
      //on remove la classe
      span.classList.remove('text-success');
      //on ajoute le classe
      span.classList.add('text-danger');
      //on ajoute un border color
      formContactMail.style.borderColor = 'red';
      return false;
   }

};