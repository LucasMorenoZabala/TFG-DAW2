crearCookie = (cNombre, cValor, expDays) => {
  var fecha = new Date();
  fecha.setTime(fecha.getTime() + expDays * 24 * 60 * 60 * 1000);
  var vence = "expires=" + fecha.toUTCString();
  document.cookie =
    cNombre + "=" + cValor + ";" + vence + "; path=../php/index.php";
};

comprobarCookie = (cNombre) => {
  var nombre = cNombre + "=";
  var cDecoded = decodeURIComponent(document.cookie);
  var cArray = cDecoded.split("; ");
  var valor;
  cArray.forEach((val) => {
    if (val.indexOf(nombre) === 0) valor = val.substring(nombre.length);
  });

  return valor;
};

document.querySelector("#cookies-btn").addEventListener("click", () => {
  document.querySelector("#cookies").style.display = none;
  crearCookie("cookie", true, 30);
});

cookieMessage = () => {
  if (!getCookies("cookie"))
    document.querySelector("#cookies").style.display = "block";
};

window.addEventListener("load", cookieMessage);
