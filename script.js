// Close icons 
const closeIcons = document.querySelectorAll(".icon_close");
const registerWrapper = document.querySelector(".wrapper_register");
const loginWrapper = document.querySelector(".wrapper_login");
const profilWrapper = document.querySelector(".wrapper_profil");
const adminWrapper = document.querySelector(".wrapper_admin");

closeIcons.forEach(icon => {
  icon.addEventListener("click", () => {
    registerWrapper.style.display = "none";
    loginWrapper.style.display = "none";
    profilWrapper.style.display = "none";
    adminWrapper.style.display = "none";
    
    logoutAndRedirect();
  });
});

function logoutAndRedirect() {

  window.location.href = "index.php";
}
