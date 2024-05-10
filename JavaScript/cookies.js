const cookieBox = document.querySelector(".wrapper"),
  buttons = document.querySelectorAll(".button");

const executeCodes = () => {
  if (document.cookie.includes("cookie")) return;
  cookieBox.classList.add("show");
  cookieBox.style.display = "block";

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      cookieBox.classList.remove("show");
      cookieBox.style.display = "none";

      if (button.id == "acceptBtn") {
        document.cookie = "cookie= cookie; max-age=" + 60 * 60 * 24 * 30;
      }
    });
  });
};

window.addEventListener("load", executeCodes);
