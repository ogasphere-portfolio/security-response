

const userMemberFormPart = document.getElementById('registration_form_userMember');
const userMembershipTypeChoices = document.getElementById('registration_form_membershipType').querySelectorAll('input');
// TODO: Récupérer la div correspondant aux champs de l'entreprise 

console.log(userMembershipTypeChoices);
userMembershipTypeChoices.forEach(function(item) {
    item.addEventListener('click', function(e) {
        if(e.currentTarget.value === 'entreprise') {
            userMemberFormPart.style.display = 'none';
            // TODO: Montrer les champs de l'entreprise
        }

        if(e.currentTarget.value === 'member') {
            userMemberFormPart.style.display = 'block';
            // TODO: Cacher les champs de l'entreprise
        }

    });
})
