// this code hanlde the last item in the sidebar, when clicked shows a settings option and a logout option;

const dropdownBtn = document.getElementById("dropdown"); // the dropdown button
const dropdown = document.getElementById("dropdown-card"); // the dropdown itself

const makeHidden = () => {
    dropdown.classList.remove("dropdown-show");
    dropdown.classList.add("dropdown-hide");
    dropdown.style.display = "none";
}

dropdownBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // Prevent the event from reaching the document click handler

  if (!dropdown.classList.contains("dropdown-show")) {
    dropdown.style.display = "block";
    dropdown.classList.remove("dropdown-hide");
    dropdown.classList.add("dropdown-show");
  } else {
      makeHidden();
  }
});

document.addEventListener("click", () => {
  if (dropdown.classList.contains("dropdown-show")) {
      makeHidden();
  }
});
