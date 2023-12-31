// this handles showing and hiding the delete box;
// const deleteBtns = document.querySelectorAll("#delete-btn"); // buttons to show the delete box;
const cancelDeleteBtn = document.querySelector("#delete-cancel"); // cancel button to hide the delete confirmation box;
const overlayForDelete = document.getElementById("overlay"); // the overlay
const deleteBoxContainer = document.querySelector("#delete-form-container"); // the container of box
const deleteForm = document.querySelector("#delete-form"); // the delete form
const IdInput = document.getElementById("id"); // the hidden input that holds the category id to be deleted;

// function that handles clicking on the delete button;
const handleDeleteClick = (e) => {

  if(
      (e.target && e.target.tagName === 'BUTTON' && e.target.id === "delete-btn") ||
      (e.target && e.target.tagName === 'IMG' && e.target.alt === "delete icon")
  )
  {
    disable_tabbing();  // already defined in the sidebar.js
    overlayForDelete.style.display = "block";
    deleteBoxContainer.style.display = "block";
  
    deleteForm.classList.remove("form-desappear");
    deleteForm.classList.add("form-appear");
  
    const button = e.target.tagName === 'BUTTON' ? e.target : e.target.parentNode;
    IdInput.value = button.value;
  }
};
// adding event listener to each delete button;
// for(let i = 0; i < deleteBtns.length; i++)
// {
//     deleteBtns[i].addEventListener("click", () => handleDeleteClick(deleteBtns[i].value));
// }
document.getElementById("table").addEventListener("click", (e) => handleDeleteClick(e))

// handles when cancel button is clicked
cancelDeleteBtn.addEventListener("click", () => {
  deleteForm.classList.remove("form-appear");
  deleteForm.classList.add("form-desappear");

  setTimeout(() => {
    deleteBoxContainer.style.display = "none";
    disable_tabbing();  // already defined in the sidebar.js
    overlayForDelete.style.display = "none";
  }, 200);
});
