//* this handles showing and hiding the form that is responsible for adding new element (categories, products ..);
const addingBtn = document.querySelector("#add-btn"); // button to show the form;
const cancelBtn = document.querySelector("#cancel-btn"); // button to hide the form;
const overlayForAddingForm = document.querySelector("#overlay"); // overlay
const addingFormContainer = document.querySelector("#adding-form-container"); // the container of the adding form
const form = document.querySelector("#form"); // the form
const inputs = document.querySelectorAll(".form-input"); // select all the inputs in the form
const smalls = document.querySelectorAll("small");

if (addingFormContainer.style.display === "block") {
  // if the page loads and the form is visible, then show the overlay;
  disable_tabbing(); // already defined in the sidebar.js
  overlay.style.display = "block";
}

// empty error message in the small tags;
const smallTags = () => smalls.forEach(small => small.innerText = "");

// clearing all the input when clicking the cancel button;
const clearInputs = () => inputs.forEach(input => input.value = "");

// handles showing the form;
const showTheForm = () => {
  disable_tabbing(); // already defined in the sidebar.js
  overlay.style.display = "block";
  addingFormContainer.style.display = "block";

  form.classList.remove("form-desappear");
  form.classList.add("form-appear");
};

// addingBtn event listener;
addingBtn.addEventListener("click", () => {
  clearInputs();
  smallTags();
  showTheForm();
});

cancelBtn.addEventListener("click", () => {
  form.classList.remove("form-appear");
  form.classList.add("form-desappear");

  setTimeout(() => {
    disable_tabbing(); // already defined in the sidebar.js
    overlay.style.display = "none";
    addingFormContainer.style.display = "none";
  }, 200);

  clearInputs();

  form.children[0].textContent = "Add New Record"; // update the title of the form
});

// the table structure is like this: <tr></tr> => multiple <td> | <td></td> => <p>textContent</p>
// this handles the update process
const handleClick = (e) => {
  if (
    (e.target && e.target.tagName === "BUTTON" && e.target.id === "modify-btn") ||
    (e.target && e.target.tagName === "IMG" && e.target.alt === "modify icon")
  ) {
    smallTags();
    const updateBtn = e.target.tagName === "BUTTON" ? e.target : e.target.parentNode; // get the clicked update button;
    const td = updateBtn.parentNode; // get the td (table data) that in which the button exist;
    const tr = td.parentNode; // get the tr (table row) in which the td exist;
    const tds = tr.children; // get all the td tags or children of the tr;
    const inputsValue = []; // this array will hold all the data of the table row the user wants to update

    // we have a hidden <td> that contains the description, followed by a <td> with the excerpt, the excerpt should not be pushed to the inputsValue array that will be affected to the inputs as their values;
    let isPreviousTdHidden = false; // if we reach the hidden td tag, it becomes true;

    for (tableData of tds) {
      if (isPreviousTdHidden) {
        // if the previous td tag is hidden then it is the description one, the current one the excerpt, that's why we skip it;
        isPreviousTdHidden = false;
        continue;
      }
      isPreviousTdHidden = tableData.style.display === "none"; // if the display is none, then make true
      const p = tableData.childNodes[1] ?? tableData.childNodes[0];
      const trimmedValue = p.outerText?.trim();
      inputsValue.push(trimmedValue); // childNodes[1].textContent gets the text in the <p></p> in the <td></td>
    }

    inputsValue.pop(); // remove the last item in the array, because it is not a part of the table data, its the last column in the table (the actions column);
    
    inputs[0].value = updateBtn.value; // the first input is the hidden input that will hold the id
    for (let i = 1; i < inputs.length; i++) {
      if (inputs[i].tagName === "SELECT") {

        // if it is a <select> then add selected attribute to the relevant <option>
        const options = inputs[i].children; // getting the option tags inside the select tag
        for (let j = 0; j < options.length; j++) {

          if (options[j].textContent === inputsValue[i - 1]) {
            options[j].selected = true;
            break;
          }
        }
      } else { // if it is an <input>
        inputs[i].value = inputsValue[i - 1];
      }
    }
    form.children[0].textContent = "Update This Record"; // update the title of the form
    showTheForm();
  }
};

document
  .getElementById("table")
  .addEventListener("click", (e) => handleClick(e));
