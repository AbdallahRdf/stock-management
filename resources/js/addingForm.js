// this handles showing and hiding the form that is responsible for adding new element (categories, products ..);
const addingBtn = document.querySelector("#add-btn"); // button to show the form;
const cancelBtn = document.querySelector("#cancel-btn"); // button to hide the form;
const overlay = document.querySelector("#overlay");
const form = document.querySelector("#form");
const inputs = document.querySelectorAll("input"); // select all the inputs in the form

addingBtn.addEventListener("click", () => 
{
    overlay.style.display = "block";

    form.classList.remove("form-desappear");
    form.classList.add("form-appear");
});

cancelBtn.addEventListener("click", () => 
{
    form.classList.remove("form-appear");
    form.classList.add("form-desappear");

    setTimeout(() => {
        overlay.style.display = "none";
    }, 200);

    // clearing all the input when clicking the cancel button;
    for(let i = 0; i < inputs.length; i++)
    {
        inputs[i].value = "";
    }
    inputs[inputs.length - 1].value = "";
});