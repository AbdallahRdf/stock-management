//* this block handles the login alert
const theAlert = document.querySelector(".alert");
const alertDismissBtn = document.querySelector(".alert-dismiss");

alertDismissBtn.addEventListener("click", () => {
  theAlert.classList.add("d-hidden");
});

//* this block of code handles switching between the login form and signup form;
const loginBtn = document.querySelector("#login");
const signupBtn = document.querySelector("#signup");

// shows the login form and hides the signup form
const showLoginForm = () => {
  document.getElementById("loginPart").style.display = "block";
  document.getElementById("signupPart").style.display = "none";
};

// shows the signup form and hides the login form
const showSignupForm = () => {
  document.getElementById("loginPart").style.display = "none";
  document.getElementById("signupPart").style.display = "block";

  if(!theAlert.classList.contains("d-hidden")){
    theAlert.classList.add("d-hidden");
  }
};

// adds to the button the selected style, and removes the unselected
const addStyle = (element) => {
  element.classList.add("selected-control-btn");
  element.classList.remove("unselected-control-btn");
};

// adds to the button the unselected style, and removes the selected
const removeStyle = (element) => {
  element.classList.add("unselected-control-btn");
  element.classList.remove("selected-control-btn");
};

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
