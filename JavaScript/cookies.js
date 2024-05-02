document.addEventListener("DOMContentLoaded", function () {
  var cookieBox = document.querySelector(".wrapper"),
    buttons = document.querySelectorAll(".button");

  var executeCodes = () => {
    if (document.cookie.includes("cookie")) return;

    cookieBox.classList.add("show");

    buttons.forEach(function (button) {
      button.addEventListener("click", function () {
        cookieBox.classList.remove("show");

        if (button.id == "acceptBtn") {
          document.cookie = "cookie=cookie; max-age=" + 60 * 60 * 24 * 30;
        }
      });
    });
  };
  window.addEventListener("load", executeCodes);
});
