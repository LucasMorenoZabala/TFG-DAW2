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
    inputElement.parentElement.appendChild(errorDiv);
  }
  errorElement.textContent = errorMessage;
  inputElement.style.background = "red";
}

function esconderError(inputElement) {
  var errorElement = inputElement.nextElementSibling;
  if (errorElement) {
    errorElement.textContent = "";
    inputElement.style.background = "";
  }
}

InputUsuario.addEventListener("keyup", function (event) {
  var usuario = event.target.value;
  if (validateUsername(usuario)) {
    esconderError(InputUsuario);
    inputElement.style.backgroundColor = "green";
  } else {
    mostrarError(
      InputUsuario,
      "El nombre de usuario debe tener entre 4 y 20 caracteres y puede contener letras, números, guiones bajos, puntos y guiones."
    );
  }
});

InputClave.addEventListener("keyup", function (event) {
  var clave = event.target.value;
  if (validatePassword(clave)) {
    esconderError(InputClave);
    inputElement.style.backgroundColor = "green";
  } else {
    mostrarError(
      InputClave,
      "La contraseña debe tener al menos 8 caracteres, incluyendo una minúscula, una mayúscula, un número y un carácter especial (@, $, !, %, *, &, etc.)."
    );
  }
});

InputEmail.addEventListener("keyup", function (event) {
  var email = event.target.value;
  if (validateEmail(email)) {
    esconderError(InputEmail);
    inputElement.style.backgroundColor = "green";
  } else {
    mostrarError(InputEmail, "El formato del correo electrónico no es válido.");
  }
});
