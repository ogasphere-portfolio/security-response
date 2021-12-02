document.addEventListener('DOMContentLoaded', () => {
  const eyes = document.querySelectorAll(".fa-eye-slash");

  for (let index = 0; index < eyes.length; index++) {
    const element = [...eyes][index];
    element.addEventListener('click', () => {
      changeEye(element)
    });
  }

  const changeEye = (element) => {    
    let password = element.previousElementSibling.children[1];

    if (element.classList.contains("fa-eye-slash")) {
      element.classList.remove('fa-eye-slash')
      element.classList.add('fa-eye')
      password.type = 'text';
      
    } else {
      element.classList.add('fa-eye-slash')
      element.classList.remove('fa-eye')
      password.type = "password";
    }
  }
});