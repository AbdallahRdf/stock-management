<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['orders']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Date", "Client", "Actions"];

$clients = $_SESSION["clients"]; // getting all the clients, they will be shown in the select in the from;
// error messages for the form;
$date_error_message = $_SESSION["errors"]["date_error"] ?? "";

// old input values
$old_date = $_SESSION["old"]["old_date"] ?? "";
$old_client = $_SESSION["old"]["old_client"] ?? "";
$old_id = $_SESSION["old"]["old_id"] ?? "";


$display_proprety = $_SESSION["errors"] ? "block" : "none";
// empty the session variable
if (isset($_SESSION["errors"])) {
    unset($_SESSION["errors"]);
    unset($_SESSION["old"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- requiring <head> tag -->
<?php require_once "../commun/head.php"; ?>

<body>
    <!-- main.php contains the overlay, the sidebar, the alert, the table -->
    <?php require_once "../commun/main.php"; ?>

    <!-- Form to add elements to the table -->
    <div id="adding-form-container" style="display:<?= $display_proprety ?>">
        <form id="form" class="form" action="../../../controllers/OrderController.php" method="POST">
            <h3>Add New Order</h3>

            <input type="hidden" name="order_id" class="form-input" value="<?= $old_id ?>">
            <div class="input-group">
                <label for="date">Order Date</label>
                <input class="form-input" id="date" type="date" name="date" value="<?= $old_date ?>">
                <small>
                    <?= $date_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="client">Select the client who placed the order.</label>
                <div class="custom-select">
                    <select name="client_id" class="form-input" id="client" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach ($clients as $client) : ?>
                            <option value="<?= $client["id"] ?>" <?= (string)$client["id"] === (string)$old_client ? 'selected' : '' ?>><?= $client["full_name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="btns">
                <button id="cancel-btn" class="cancel-btn" type="button">Cancel</button>
                <button class="submit-btn" type="submit">Save</button>
            </div>
        </form>
    </div>

    <!-- form for deleting an element from the table -->
    <div id="delete-form-container" class="delete-form-container">
        <form action="../../../controllers/OrderController.php" method="post" id="delete-form" class="delete-form">
            <p class="delete-message">Are you sure you want to delete this record permanently?</p>
            <input type="hidden" name="order_id" id="id" value="">
            <div>
                <button type="button" id="delete-cancel" class="delete-cancel">Cancel</button>
                <button type="submit" class="delete-delete">Delete</button>
            </div>
        </form>
    </div>

    <!-- requiring the js script tags -->
    <?php require_once "../commun/jsScripts.php"; ?>
</body>

</html>