<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['supplierOrders']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Date", "Supplier", "Actions"];

$suppliers = $_SESSION["suppliers"]; // getting all the suppliers, they will be shown in the select in the from;
// error messages for the form;
$date_error_message = $_SESSION["errors"]["date_error"] ?? "";

// old input values
$old_date = $_SESSION["old"]["old_date"] ?? "";
$old_supplier = $_SESSION["old"]["old_supplier"] ?? "";

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
        <form id="form" class="form" action="../../../controllers/SuppOrderController.php" method="POST">
            <h3>Add New Order</h3>

            <input type="hidden" name="supplierOrder_id" class="form-input">
            <div class="input-group">
                <label for="date">Order Date</label>
                <input class="form-input" id="date" type="date" name="date" value="<?= $old_date ?>">
                <small>
                    <?= $date_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="supplier">Select the supplier who placed the order.</label>
                <div class="custom-select">
                    <select name="supplier_id" class="form-input" id="supplier" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <option value="<?= $supplier["id"] ?>" <?= (string)$supplier["id"] === (string)$old_supplier ? 'selected' : '' ?>><?= $supplier["full_name"] ?></option>
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
        <form action="../../../controllers/SuppOrderController.php" method="post" id="delete-form" class="delete-form">
            <p class="delete-message">Are you sure you want to delete this record permanently?</p>
            <input type="hidden" name="supplierOrder_id" id="id" value="">
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