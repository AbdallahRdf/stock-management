<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;



$items = $_SESSION["orderedProducts"]; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Product", "Quantity", "Actions"];

$products = $_SESSION["products"]; // getting all the categories, they will be shown in the select in the from;
// error messages for the form;
$quantity_error_message = $_SESSION["errors"]["quantity_error"] ?? "";

// old input values
$old_quantity = $_SESSION["old"]["old_quantity"] ?? "";
$old_product = $_SESSION["old"]["old_product"] ?? "";

$display_proprety = $_SESSION["errors"] ? "block" : "none";
if (isset($_SESSION["errors"])) // if there is an error after creating new element;
{
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
        <form id="form" class="form" action="../../../controllers/OrderedProdsController.php" method="POST">
            <h3>Add New Record</h3>

            <input type="hidden" name="ordered_p_id" class="form-input">

            <div class="input-group">
                <label for="product">Select the Ordered Product</label>
                <div class="custom-select">
                    <select name="product_id" class="form-input" id="product" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product["id"] ?>" <?= (string)$product["id"] === (string)$old_product ? 'selected' : '' ?>><?= $product["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="input-group">
                <label for="quantity">Product Quantity</label>
                <input class="form-input" id="quantity" type="quantity" name="quantity" value="<?= $old_quantity ?>">
                <small>
                    <?= $quantity_error_message ?>
                </small>
            </div>

            <div class="btns">
                <button id="cancel-btn" class="cancel-btn" type="button">Cancel</button>
                <button class="submit-btn" type="submit">Save</button>
            </div>
        </form>
    </div>

    <!-- form for deleting an element from the table -->
    <div id="delete-form-container" class="delete-form-container">
        <form action="../../../controllers/OrderedProdsController.php" method="post" id="delete-form" class="delete-form">
            <p class="delete-message">Are you sure you want to delete this record permanently?</p>
            <input type="hidden" name="ordered_p_id" id="id" value="">
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