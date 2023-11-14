const dismissAlertBtn = document.getElementById("dismiss-alert"); // the 'x' button to dismiss an alert
const alertCard = document.getElementById("alert"); // the alert box;

// if there is an alert, dismiss it after 6s;
if(alertCard.style.display === "flex")
{
    setTimeout(() => {
        alertCard.style.display = "none";
    }, 6000);
}

// if the "x" button is clicked dismiss the alert
dismissAlertBtn.addEventListener("click", () => 
{
    alertCard.style.display = "none";
});