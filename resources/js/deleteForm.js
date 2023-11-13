// this handles showing and hiding the delete box;
const deleteBtns = document.querySelectorAll("#delete-btn"); // buttons to show the delete box;
const cancelDeleteBtn = document.querySelector("#delete-cancel"); // cancel button to hide the delete confirmation box;
const deleteBoxOverlay = document.querySelector("#delete-overlay"); // the dark overlay behind the box
const deleteForm = document.querySelector("#delete-form"); // the delete form
const categoryIdInput = document.getElementById("category-id"); // the hidden input that holds the category id to be deleted;

// function that handles clicking on the delete button;
const handleDeleteClick = (categoryID) => {
  deleteBoxOverlay.style.display = "block";

  deleteForm.classList.remove("form-desappear");
  deleteForm.classList.add("form-appear");

  categoryIdInput.value = categoryID;
};
// adding event listener to each delete button;
for(let i = 0; i < deleteBtns.length; i++)
{
    deleteBtns[i].addEventListener("click", () => handleDeleteClick(deleteBtns[i].value));
}
// handles when cancel button is clicked
cancelDeleteBtn.addEventListener("click", () => {
  deleteForm.classList.remove("form-appear");
  deleteForm.classList.add("form-desappear");

  setTimeout(() => {
    deleteBoxOverlay.style.display = "none";
  }, 200);
});
