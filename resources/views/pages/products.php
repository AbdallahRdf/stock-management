<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['products']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Name", "Description", "Price", "Quantity", "Category", "Actions"];

$categories = $_SESSION['categories']; // getting all the categories, they will be shown in the select in the from;

// error messages for the form;
$name_error_message = $_SESSION["errors"]["name_error"] ?? "";
$email_error_message = $_SESSION["errors"]["description_error"] ?? "";
$number_error_message = $_SESSION["errors"]["price_error"] ?? "";
$date_error_message = $_SESSION["errors"]["quantity_error"] ?? "";

// old input values
$old_name = $_SESSION["old"]["old_name"] ?? "";
$old_email = $_SESSION["old"]["old_description"] ?? "";
$old_number = $_SESSION["old"]["old_price"] ?? "";
$old_date = $_SESSION["old"]["old_quantity"] ?? "";
$old_category = $_SESSION["old"]["old_category"] ?? "";

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
                <input type="hidden" name="product_id" class="form-input">
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
                <label for="price">Product Price</label>
                <input class="form-input" type="text" name="price" placeholder="Product Price" value="<?= $old_number ?>">
                <small>
                    <?= $number_error_message ?>
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
                <label for="category">Select the product category</label>
                <div class="custom-select">
                    <select name="category" class="form-input" id="category" required>
                        <option value="" disabled selected>--Select an option--</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category["id"] ?>" <?= (string)$category["id"]===(string)$old_category ? 'selected' : '' ?>><?= $category["name"] ?></option>
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
        <form action="../../../controllers/ProductController.php" method="post" id="delete-form"
            class="delete-form">
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