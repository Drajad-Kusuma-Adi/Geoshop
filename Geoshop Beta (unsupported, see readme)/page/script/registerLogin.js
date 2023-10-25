const login = document.getElementById("loginButton");
const register = document.getElementById("registerButton");

login.addEventListener("click", () => {
    window.location.replace("page/loginPage.php");
})
register.addEventListener("click", () => {
    window.location.replace("page/registerPage.php");
})