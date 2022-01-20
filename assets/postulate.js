let buttomPostulate = document.querySelectorAll('a.postulate').forEach(function (link) {
    link.addEventListener('click', oneClickPostulate);
});


function oneClickPostulate(evt) {
    evt.preventDefault();
    console.log('je suis dans ma fonction');
    const url = this.href;

    const spanCount = this.querySelector('.nb_postulant')
    const icone = this.querySelector('i');

    axios.get(url).then(function (response) {

        console.log(response);
        spanCount.textContent = response.data.postulant;
        if(icone.classList.contains('fas')) {
            icone.classList.replace('fas', 'far');
        } else {
            icone.classList.replace('far', 'fas');
        }
    }).catch(function (error) {
        if(error.response.status === 403) {
            windows.alert('vous ne passerais pas')
        }
    });
};