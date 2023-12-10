<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['products']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Name", "Description", "Purchase Price", "Selling Price", "Quantity", "Supplier",  "Category", "Actions"];

$categories = $_SESSION['categories']; // getting all the categories, they will be shown in the select in the from;
$suppliers = $_SESSION['suppliers']; // getting all the suppliers, they will be shown in the select in the from;
// error messages for the form;
$name_error_message = $_SESSION["errors"]["name_error"] ?? "";
$email_error_message = $_SESSION["errors"]["description_error"] ?? "";
$pprice_error_message = $_SESSION["errors"]["p_price_error"] ?? "";
$date_error_message = $_SESSION["errors"]["quantity_error"] ?? "";
$sprice_error_message = $_SESSION["errors"]["s_price_error"] ?? "";

// old input values
$old_name = $_SESSION["old"]["old_name"] ?? "";
$old_email = $_SESSION["old"]["old_description"] ?? "";
$old_p_price = $_SESSION["old"]["old_p_price"] ?? "";
$old_date = $_SESSION["old"]["old_quantity"] ?? "";
$old_category = $_SESSION["old"]["old_category"] ?? "";
$old_supplier = $_SESSION["old"]["old_supplier"] ?? "";
$old_s_price = $_SESSION["old"]["old_s_price"] ?? "";
$old_id = $_SESSION["old"]["old_id"] ?? "";

$display_proprety = $_SESSION["errors"] ? "block" : "none"; // if there is an error in the form then show the form again;

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
        <form id="form" class="form" action="../../../controllers/ProductController.php" method="POST">
            <h3>Add New Record</h3>

            <div class="input-group">
                <input type="hidden" name="product_id" class="form-input" value="<?= $old_id ?>">
                <label for="name">Product Name</label>
                <input class="form-input" id="name" type="text" name="name" placeholder="Product Name" value="<?= $old_name ?>">
                <small>
                    <?= $name_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="description">Product Description</label>
                <textarea name="description" id="description" class="form-input" cols="30" rows="4" placeholder="Product Description"><?= $old_email ?></textarea>
                <small>
                    <?= $email_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="pprice">Purchase Price</label>
                <input id="pprice" class="form-input" type="text" name="purchase_price" placeholder="Product Purchase Price" value="<?= $old_p_price ?>">
                <small>
                    <?= $pprice_error_message ?>
                </small>
            </div>
            <div class="input-group">
                <label for="s_price">Selling Price</label>
                <input id="s_price" class="form-input" type="text" name="selling_price" placeholder="Product Selling Price" value="<?= $old_s_price ?>">
                <small>
                    <?= $sprice_error_message ?>
                </small>
            </div>
            <div class="input-group">
                <label for="quantity">Product Quantity</label>
                <input class="form-input" id="quantity" type="number" min="0" name="quantity" placeholder="Product Quantity" value="<?= $old_date ?>">
                <small>
                    <?= $date_error_message ?>
                </small>
            </div>
            <div class="input-group">
                <label for="supplier">Select the product supplier</label>
                <div class="custom-select">
                    <select name="supplier" class="form-input" id="supplier" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <option value="<?= $supplier["id"] ?>" <?= (string)$supplier["id"] === (string)$old_supplier ? 'selected' : '' ?>><?= $supplier["full_name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <label for="category">Select the product category</label>
                <div class="custom-select">
                    <select name="category" class="form-input" id="category" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category["id"] ?>" <?= (string)$category["id"] === (string)$old_category ? 'selected' : '' ?>><?= $category["name"] ?></option>
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
        <form action="../../../controllers/ProductController.php" method="post" id="delete-form" class="delete-form">
            <p class="delete-message">Are you sure you want to delete this record permanently?</p>
            <input type="hidden" name="product_id" id="id" value="">
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