// this code handles toggling visibility of the sidebar;

const toggleBtn = document.querySelector("#toggle"); // toggle button;
const toBeToggled = document.getElementsByClassName("toggled"); // elements to be hidden or shown in the sidebar;
const sidebar = document.querySelector('.sidebar') // the sidebar;
const selectBtnsContainer = document.querySelector('.select-btns') // the container of the buttons on the sidebar;

// this function adds and removes specific classes to the toBeToggled elements
const hideShowElemnts = (classToAdd, classToRemove) =>
{
    for (let i = 0; i < toBeToggled.length - 1; i++) {
      toBeToggled[i].classList.remove(classToRemove);
      toBeToggled[i].classList.add(classToAdd);
    }
    toBeToggled[toBeToggled.length - 1].classList.remove(classToRemove);
    toBeToggled[toBeToggled.length - 1].classList.add(classToAdd);
}

// click event listener for the toggling button
toggleBtn.addEventListener("click", () => {
    if(toggleBtn.value === "hide")
    {
        toggleBtn.value = "show";
        toggleBtn.style.transform = "rotate(180deg)";
        
        hideShowElemnts("hide", "showe");
        
        sidebar.classList.add("reduce");
        sidebar.classList.remove("expand");

        selectBtnsContainer.classList.add("extra-top-margin");
    } 
    else
    {
        toggleBtn.value = "hide";
        toggleBtn.style.transform = "rotate(0deg)";
        
        hideShowElemnts("show", "hide");
        
        sidebar.classList.remove("reduce");
        sidebar.classList.add("expand");

        selectBtnsContainer.classList.remove("extra-top-margin");
    }
})