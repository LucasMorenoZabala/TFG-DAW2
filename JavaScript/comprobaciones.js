var InputUsuario = document.getElementById("usuario");
var InputClave = document.getElementById("clave");
var InputEmail = document.getElementById("email");

var RegexUsuario = /^[a-zA-Z0-9_.-]{4,20}$/;
var RegexClave =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

var RegexEmail =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function validateUsername(usuario) {
  return RegexUsuario.test(usuario);
}

function validatePassword(clave) {
  return RegexClave.test(clave);
}

function validateEmail(email) {
  return RegexEmail.test(email);
}

function mostrarError(inputElement, errorMessage) {
  var errorElement = inputElement.nextElementSibling;
  if (!errorElement) {
    var errorDiv = document.createElement("div");
    errorDiv.classList.add("error-message");
    inputElement.parentNode.appendChild(errorDiv);
    errorElement = errorDiv;
  }
  errorElement.textContent = errorMessage;
  errorElement.style.color = "red";
}

function esconderError(inputElement) {
  var errorElement = inputElement.nextElementSibling;
  if (errorElement) {
    errorElement.textContent = "";
  }
}

InputUsuario.addEventListener("blur", function () {
  var usuario = this.value;
  if (validateUsername(usuario)) {
    esconderError(this);
    this.style.backgroundColor = "green";
  } else {
    mostrarError(
      this,
      "El nombre de usuario debe tener entre 4 y 20 caracteres y puede contener letras, números, guiones bajos, puntos y guiones."
    );
  }
});

InputClave.addEventListener("blur", function () {
  var clave = this.value;
  if (validatePassword(clave)) {
    esconderError(this);
    this.style.backgroundColor = "green";
  } else {
    mostrarError(
      this,
      "La contraseña debe tener al menos 8 caracteres, incluyendo una minúscula, una mayúscula, un número y un carácter especial (@, $, !, %, *, &, etc.)."
    );
  }
});

InputEmail.addEventListener("blur", function () {
  var email = this.value;
  if (validateEmail(email)) {
    esconderError(this);
    this.style.backgroundColor = "green";
  } else {
    mostrarError(this, "El formato del correo electrónico no es válido.");
  }
});
