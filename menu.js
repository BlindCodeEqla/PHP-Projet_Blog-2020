var nav = document.getElementById("NavBar");
var btn = document.getElementById("menuToggle");
var message_erreur = document.querySelectorAll(".message_erreur");

btn.addEventListener("click", function () {
    nav.classList.toggle('nav_ouvrir');
  });

  
function validateForm() {
  var x = document.forms["monForm"]["pseudo"].value;
  if (x == "") {
    message_erreur.style.display="block";
    return false;
  }
}