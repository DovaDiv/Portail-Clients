const welcomeBtn = document.getElementById("welcomeBtn");
const message = document.getElementById("message");

welcomeBtn.addEventListener("click", function () {
  message.textContent = "Bienvenue dans notre portail de gestion des clients !";
});
