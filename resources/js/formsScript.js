//* this block of code handles switching between the login form and signup form;
const loginBtn = document.querySelector("#login");
const signupBtn = document.querySelector("#signup");

//* clears inputs
const clearInputs = (className) => {
    const inputs = document.getElementsByClassName(className);
    for (let i = 0; i < inputs.length - 1; i++) {
      inputs[i].value = "";
    }
    inputs[inputs.length - 1].value = "";
}

// shows the login form and hides the signup form
const showLoginForm = () => {
    document.getElementById("loginPart").style.display = "block";
    document.getElementById("signupPart").style.display = "none";

    clearInputs("signup-input");
}

// shows the signup form and hides the login form
const showSignupForm = () => {
    document.getElementById("loginPart").style.display = "none";
    document.getElementById("signupPart").style.display = "block";

    clearInputs("login-input");
}

// adds to the button the selected style, and removes the unselected
const addStyle = (element) => {
    element.classList.add("selected-control-btn");
    element.classList.remove("unselected-control-btn");
}

// adds to the button the unselected style, and removes the selected
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
