//* this handles showing and hiding the form that is responsible for adding new element (categories, products ..);
const addingBtn = document.querySelector("#add-btn"); // button to show the form;
const cancelBtn = document.querySelector("#cancel-btn"); // button to hide the form;
const overlayForAddingForm = document.querySelector("#overlay"); // overlay
const addingFormContainer = document.querySelector("#adding-form-container"); // the container of the adding form
const form = document.querySelector("#form"); // the form
const inputs = document.querySelectorAll(".form-input"); // select all the inputs in the form

// handles showing the form;
const showTheForm = () => {
    overlay.style.display = "block";
    addingFormContainer.style.display = "block";

    form.classList.remove("form-desappear");
    form.classList.add("form-appear");   
}

addingBtn.addEventListener("click", () => showTheForm());

cancelBtn.addEventListener("click", () => 
{
    form.classList.remove("form-appear");
    form.classList.add("form-desappear");

    setTimeout(() => {
        overlay.style.display = "none";
        addingFormContainer.style.display = "none";
    }, 200);

    // clearing all the input when clicking the cancel button;
    for(let i = 0; i < inputs.length; i++)
    {
        inputs[i].value = "";
    }
    inputs[inputs.length - 1].value = "";
});


//* this handles showing and hiding the form that is responsible for updating new element (categories, products ..);
const updateBtns = document.querySelectorAll("#modify-btn");

// the table structure is like this: <tr></tr> => multiple <td> | <td></td> => <p>textContent</p>
const handleClick = (e) => {
    const updateBtn = e.currentTarget; // get the clicked update button;
    const td = updateBtn.parentNode; // get the td (table data) that in which the button exist;
    const tr = td.parentNode; // get the tr (table row) in which the td exist;
    const tds = tr.children; // get all the td tags or children of the tr;
    const inputsValue = []; // this array will hold all the data of the table row the user wants to update
    for(tableData of tds)
    {
        inputsValue.push(tableData.childNodes[1].textContent); // childNodes[1].textContent gets the text in the <p></p> in the <td></td>
    }
    inputsValue.pop(); // remove the last item in the array, because it is not a part of the table data, its the last column in the table (the actions column);
    for(let i = 0; i < inputs.length; i++){
        if(i===0) // the first input is the hidden input that will hold the id
        {
            inputs[0].value = updateBtn.value;
        }
        else
        {
            inputs[i].value = inputsValue[i-1];
        }
    }
    showTheForm();
}
// adding event listener to each update button in the table;
for(let i = 0; i < updateBtns.length; i++)
{
    updateBtns[i].addEventListener("click", (e) => handleClick(e));
}