

const userMemberFormPart = document.getElementById('registration_form_userMember');
// const userMembershipTypeChoices = document.getElementById('registration_form_membershipType').querySelectorAll('input');
const userMembershipTypeChoices = document.getElementById('choice-register').querySelectorAll('div');

// TODO: Récupérer la div correspondant aux champs de l'entreprise 
const userEnterpriseFormPart = document.getElementById('registration_form_userEnterprise');

// console.log(userMembershipTypeChoices);
// userMembershipTypeChoices.forEach(function(item) {
//     item.addEventListener('click', function(e) {
//         if(e.currentTarget.value === 'enterprise') {
//             userMemberFormPart.style.display = 'none';
//             // TODO: Montrer les champs de l'entreprise
//             userEnterpriseFormPart.style.display = 'block';
//         }

//         if(e.currentTarget.value === 'member') {
//             userMemberFormPart.style.display = 'block';
//             // TODO: Cacher les champs de l'entreprise
//             userEnterpriseFormPart.style.display = 'none';
//         }

//     });
// })


userMembershipTypeChoices.forEach(function(item) {
    item.addEventListener('click', function(e) {
        if(e.currentTarget.id === 'register-enterprise') {
            userMemberFormPart.style.display = 'none';
            // TODO: Montrer les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'block';
        }

        if(e.currentTarget.id === 'register-member') {

            userMemberFormPart.style.display = 'block';
            // TODO: Cacher les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'none';
        }

    });
})