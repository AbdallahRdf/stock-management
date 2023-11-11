// this code handles toggling visibility of the sidebar;

const toggleBtn = document.querySelector("#toggle"); // toggle button;
const toBeToggled = document.getElementsByClassName("toggled"); // elements to be hidden or shown in the sidebar;
const sidebar = document.querySelector('.sidebar') // the sidebar;

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

toggleBtn.addEventListener("click", () => {
    if(toggleBtn.value === "visible") // if the sidebar is visible
    {
        toggleBtn.value = "hidden"; // change the toggle button value to hidden
        toggleBtn.style.left = "8px"; // move the toggle button by 8px to the left
        toggleBtn.style.transform = "rotate(180deg)"; // flip the icon of the toggle button

        hideShowElemnts("hide", "show"); // hide the elements in the sidebar

        // hide the sidebar
        sidebar.classList.add("reduce");
        sidebar.classList.remove("expand");
    } 
    else // else if the sidebar is visible
    {
        toggleBtn.value = "visible"; // change the toggle button value to visible
        toggleBtn.style.left = "170px"; // move the toggle button by 170px to the right
        toggleBtn.style.transform = "rotate(0deg)"; // flip the icon of the toggle button
        
        hideShowElemnts("show", "hide"); // show the elements in the sidebar
        
        // show the sidebar
        sidebar.classList.remove("reduce");
        sidebar.classList.add("expand");

    }
})


// this code below handles showing an "are you sure" box when trying to logout;
const logoutBtn = document.querySelector("#logout-toggle"); //logout button in the sidebar
const logoutCancel = document.querySelector("#logout-cancel"); // cancel the logout in the card
const logoutCard = document.querySelector("#logout-card"); // logout card or box
const logoutOverlay = document.querySelector("#logout-overlay"); // overlay behind the logout box

logoutBtn.addEventListener("click", () => 
{
    logoutCard.classList.remove("card-desappear");
    logoutCard.classList.add("card-appear");

    logoutOverlay.style.display = "block"
})

logoutCancel.addEventListener("click", () => 
{  
   logoutCard.classList.remove("card-appear");
    logoutCard.classList.add("card-desappear");

    setTimeout(() => {
        logoutOverlay.style.display = "none";
    }, 200);
})