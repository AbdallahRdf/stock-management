//* this block of code handles switching between the login form and signup form;
const loginBtn = document.querySelector("#login");
const signupBtn = document.querySelector("#signup");

//* shows the login form and hides the signup form
const showLoginForm = () => {
    document.getElementById("loginPart").style.display = "block";
    document.getElementById("signupPart").style.display = "none";
}

//* shows the signup form and hides the login form
const showSignupForm = () => {
    document.getElementById("loginPart").style.display = "none";
    document.getElementById("signupPart").style.display = "block";
}

//* adds to the button the selected style, and removes the unselected
const addStyle = (element) => {
    element.classList.add("selected-control-btn");
    element.classList.remove("unselected-control-btn");
}

//* adds to the button the unselected style, and removes the selected
const removeStyle = (element) => {
    element.classList.add("unselected-control-btn");
    element.classList.remove("selected-control-btn");
}

loginBtn.addEventListener("click", () => {
    showLoginForm();
    addStyle(loginBtn);
    removeStyle(signupBtn);
});

signupBtn.addEventListener("click", () => {
    showSignupForm();
    removeStyle(loginBtn);
    addStyle(signupBtn);
});



const inputs = document.getElementsByTagName("input");

for(let i = 0; i < inputs.length - 1; i++){
    inputs[i].value = "";

    inputs[i].addEventListener("input", () => {
        if(inputs[i].value !== ""){
            const label = inputs[i].parentNode.childNodes[1];
            label.classList.add("label-out-input");
            label.classList.remove("label-in-input");
        }
        if(inputs[i].value === ""){
            const label = inputs[i].parentNode.childNodes[1];
            label.classList.add("label-in-input");
            label.classList.remove("label-out-input");
        }
    })
}