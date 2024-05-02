document
  .getElementById("formularioRegistro")
  .addEventListener("focusout", validaciones);
function validaciones(event) {
  var usuario = event.target.id;

  switch (usuario) {
    case usuario:
      if (usuario.value.length < 5) {
        mostrarError("El usuario debe tener al menos 5 caracteres.");
        siEsInvalido(usuario);
        return;
      }
      EsValido(usuario);
      break;

    case email:
      if (!email.value.includes("@")) {
        mostrarError("El correo electrónico debe contener un @.");
        siEsInvalido(email);
        return;
      }
      EsValido(email);
      break;

    case clave:
      if (clave.value.length < 10) {
        mostrarError("La contraseña debe tener al menos 10 caracteres.");
        siEsInvalido(clave);
        return;
      }
      EsValido(clave);
      break;

    default:
      alert("Todos los campos han sido correctamente enviados.");
  }
}

function siEsInvalido(inputElement) {
  inputElement.style.border = "2px solid red";
}

function EsValido(inputElement) {
  inputElement.style.border = "2px solid green";
}

function mostrarError(mensaje) {
  alert(mensaje);
}
