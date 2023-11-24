<?php
$alert_message = "";
$alert_color_class = "";
$alert_display = "none";
$dismiss_alert_svg = "close"; // this 'x' color is red
if (isset($_SESSION["alert"])) // if there is an alert then:
{
    if (isset($_SESSION["deleting_successfully_alert"])) // if the element is deleted successfully then:
    {
        $alert_message = $_SESSION["deleting_successfully_alert"];
        unset($_SESSION["deleting_successfully_alert"]);
        $alert_color_class = "red-alert";
    } 
    else if (isset($_SESSION["created_successfully_alert"])) // if the element is created successfully then:
    {
        $alert_message = $_SESSION["created_successfully_alert"];
        unset($_SESSION["created_successfully_alert"]);
        $alert_color_class = "green-alert";
        $dismiss_alert_svg = "dismiss-update-alert"; // this 'x' color is green
    } 
    else if (isset($_SESSION["deleting_fails_alert"])) // if the element can't be deleted, because of foreign key constarint
    {
        $alert_message = $_SESSION["deleting_fails_alert"];
        unset($_SESSION["deleting_fails_alert"]);
        $alert_color_class = "blue-alert";
        $dismiss_alert_svg = "dismiss-info-alert"; // this 'x' color is info
    } 
    else if (isset($_SESSION["updated_successfully_alert"])) // if the element is created successfully then:
    {
        $alert_message = $_SESSION["updated_successfully_alert"];
        unset($_SESSION["updated_successfully_alert"]);
        $alert_color_class = "green-alert";
        $dismiss_alert_svg = "dismiss-update-alert"; // this 'x' color is green
    }
    unset($_SESSION['alert']);
    $alert_display = "flex";
}
?>

<!-- alert -->
<div id="alert" class="alert <?= $alert_color_class ?>" style="display:<?= $alert_display ?>">
    <?= $alert_message ?>
    <button id="dismiss-alert" class="dismiss-alert">
        <img src="../../img/<?= $dismiss_alert_svg ?>.svg" alt="dismiss alert">
    </button>
</div>