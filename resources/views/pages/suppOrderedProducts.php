<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

// no product
$categories = $_SESSION['categories']; // getting all the categories, they will be shown in the select in the from;
$suppliers = $_SESSION['suppliers']; // getting all the suppliers, they will be shown in the select in the from;
// error messages for the form;
$name_error_message = $_SESSION["errors1"]["name_error"] ?? "";
$email_error_message = $_SESSION["errors1"]["description_error"] ?? "";
$pprice_error_message = $_SESSION["errors1"]["p_price_error"] ?? "";
$date_error_message = $_SESSION["errors1"]["quantity_error"] ?? "";
$sprice_error_message = $_SESSION["errors1"]["s_price_error"] ?? "";
// old input values
$old_name = $_SESSION["old"]["old_name"] ?? "";
$old_email = $_SESSION["old"]["old_description"] ?? "";
$old_p_price = $_SESSION["old"]["old_p_price"] ?? "";
$old_date = $_SESSION["old"]["old_quantity"] ?? "";
$old_category = $_SESSION["old"]["old_category"] ?? "";
$old_supplier = $_SESSION["old"]["old_supplier"] ?? "";
$old_s_price = $_SESSION["old"]["old_s_price"] ?? "";
$old_id = $_SESSION["old"]["old_id"] ?? "";



$current_page = get_current_view();



//////////////////////

$items = $_SESSION["supplierOrderedProducts"]; // items to be shown in the table;
$supplier = $_SESSION["supplier"];
$table_header = ["Product", "Quantity", "Actions"];
$supplierOrderId = $_SESSION["supplierOrderId"];
$products = $_SESSION["products"];
$quantity_error_message = $_SESSION["errors"]["quantity_error"] ?? "";

// old input values
$old_quantity = $_SESSION["old"]["old_quantity"] ?? "";
$old_product = $_SESSION["old"]["old_product"] ?? "";
$old_id = $_SESSION["old"]["old_id"] ?? "";

if ($_SESSION["errors"]) {
    $display_proprety = "block";
    $display_proprety1 = "none";
} else if ($_SESSION["errors1"]) {
    $display_proprety = "none";
    $display_proprety1 = "block";
} else {
    $display_proprety = "none";
    $display_proprety1 = "none";
}


if (empty($products)) {
    $display_button = "none";
} else {
    $display_button = "block";
}
if (isset($_SESSION["errors1"])) // if there is an error after creating new element;
{
    unset($_SESSION["errors1"]);
    unset($_SESSION["old"]);
}
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
    <?php
    if (empty($products)) {
        require_once "../commun/main2.php";
    } else {
        require_once "../commun/main.php";
    }

    ?>


    <!-- Form to add elements to the table -->
    <div>
        <div id="adding-form-container" style="display:<?= $display_proprety ?>">
            <form id="form" class="form" action="../../../controllers/SuppOrderedProdsController.php" method="POST">
                <h3>Add New Record</h3>

                <input type="hidden" name="supplierOrdered_p_id" class="form-input" value="<?= $old_id ?>">

                <!--<input type="hidden" name="orderId" class="form-input" value="</*?= $orderId ?>">-->

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
            <form action="../../../controllers/SuppOrderedProdsController.php" method="post" id="delete-form" class="delete-form">
                <p class="delete-message">Are you sure you want to delete this record permanently?</p>
                <input type="hidden" name="supplierOrdered_p_id" id="id" value="">
                <div>
                    <button type="button" id="delete-cancel" class="delete-cancel">Cancel</button>
                    <button type="submit" class="delete-delete">Delete</button>
                </div>
            </form>
        </div>

    </div>

    <!-- requiring the js script tags -->
    <?php require_once "../commun/jsScripts.php"; ?>


</body>

</html>