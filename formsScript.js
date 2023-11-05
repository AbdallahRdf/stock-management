//* this block of code handles switching between the login form and signup form;
const loginBtn = document.querySelector("#login");
const signupBtn = document.querySelector("#signup");

loginBtn.addEventListener("click", () => {
    document.getElementById("loginPart").style.display = "block";
    document.getElementById("signupPart").style.display = "none";
});

signupBtn.addEventListener("click", () => {
    document.getElementById("loginPart").style.display = "none";
    document.getElementById("signupPart").style.display = "block";
});