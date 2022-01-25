let buttomPostulate = document.querySelectorAll('a.postulate').forEach(function (link) {
    link.addEventListener('click', oneClickPostulate);
});
let span = document.createElement('span');


function oneClickPostulate(evt) {
    evt.preventDefault();
    const url = this.href;

    const spanCount = this.querySelector('.nb_candidats')
    const icone = this.querySelector('i');

    axios.post(url).then(function (response) {

        console.log(response);
        spanCount.textContent = response.data.candidats;
        if(icone.classList.contains('fas')) {
            icone.classList.replace('fas', 'far');
        } else {
            icone.classList.replace('far', 'fas');
        }
    }).catch(function (error) {
        console.log(error);
        return false
    });
};