<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['clients']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Full Name", "Email", "Phone number", "Registration Date", "Actions"];

$categories = $_SESSION['categories']; // getting all the categories, they will be shown in the select in the from;

// error messages for the form;
$name_error_message = $_SESSION["errors"]["name_error"] ?? "";
$description_error_message = $_SESSION["errors"]["description_error"] ?? "";
$price_error_message = $_SESSION["errors"]["price_error"] ?? "";
$quantity_error_message = $_SESSION["errors"]["quantity_error"] ?? "";

// old input values
$old_name = $_SESSION["old"]["old_name"] ?? "";
$old_description = $_SESSION["old"]["old_description"] ?? "";
$old_price = $_SESSION["old"]["old_price"] ?? "";
$old_quantity = $_SESSION["old"]["old_quantity"] ?? "";
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
    <title>InventoSync</title>
    <link rel="stylesheet" href="../../styles/sidebar.css">
    <link rel="stylesheet" href="../../styles/overlay.css">
    <link rel="stylesheet" href="../../styles/table.css">
    <link rel="stylesheet" href="../../styles/addingForm.css">
    <link rel="stylesheet" href="../../styles/deleteForm.css">
    <link rel="stylesheet" href="../../styles/alert.css">
</head>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <!-- sidebar -->
        <?php require_once "../components/sidebar.php"; ?>

        <main class="main">

            <!-- alert -->
            <?php require_once "../components/alert.php"; ?>

            <!-- table -->
            <?php require_once "../components/table.php"; ?>
        </main>
    </div>

    <!-- Form to add elements to the table -->
    <div id="adding-form-container" style="display:<?= $display_proprety ?>">
        <form id="form" class="form" action="../../../controllers/ProductController.php" method="POST">
            <h3>Create New Product</h3>

            <div class="input-group">
                <input type="hidden" name="product_id" class="form-input">
                <input class="form-input" type="text" name="name" placeholder="Product Name" value="<?= $old_name ?>">
                <small>
                    <?= $name_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <textarea name="description" class="form-input" cols="30" rows="4"
                    placeholder="Product Description"><?= $old_description ?></textarea>
                <small>
                    <?= $description_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <input class="form-input" type="text" name="price" placeholder="Product Price"
                    value="<?= $old_price ?>">
                <small>
                    <?= $price_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <input class="form-input" type="number" min="0" name="quantity" placeholder="Product Quantity"
                    value="<?= $old_quantity ?>">
                <small>
                    <?= $quantity_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="category">Select the product category</label>
                <div class="custom-select">
                    <select name="category" class="form-input" id="category">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category["id"] ?>" <?= (string) $category["id"] === (string) $old_category ? 'selected' : '' ?>>
                                <?= $category["name"] ?>
                            </option>
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

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/addUpdateForm.js"></script>
    <script src="../../js/deleteForm.js"></script>
    <script src="../../js/alert.js"></script>
</body>

</html>