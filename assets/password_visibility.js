const eye = document.querySelectorAll(".fa-eye");
const eyeoff = document.querySelectorAll(".fa-eye-slash");
const passwordField = document.querySelectorAll("input[type=password]");

eye.forEach(function(currentValue) {
  console.log(currentValue);
});

eye.forEach(function(currentValue) {
  console.log(currentValue);
});

eye.addEventListener("click", () => {
  eye.style.display = "none";
  eyeoff.style.display = "block";

  passwordField.type = "text";
});

eyeoff.addEventListener("click", () => {
  eyeoff.style.display = "none";
  eye.style.display = "block";

  passwordField.type = "password";
});