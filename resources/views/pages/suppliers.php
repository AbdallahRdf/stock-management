<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION['suppliers']; // items to be shown in the table;

// the title of the <th> tags
$table_header = ["Full Name", "Email", "Phone number", "Registration Date", "Actions"];

// error messages for the form;
$name_error_message = $_SESSION["errors"]["name_error"] ?? "";
$email_error_message = $_SESSION["errors"]["email_error"] ?? "";
$number_error_message = $_SESSION["errors"]["number_error"] ?? "";

// old input values
$old_name = $_SESSION["old"]["old_name"] ?? "";
$old_email = $_SESSION["old"]["old_email"] ?? "";
$old_number = $_SESSION["old"]["old_number"] ?? "";
$old_date = $_SESSION["old"]["old_date"] ?? "";

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
        <form id="form" class="form" action="../../../controllers/SupplierController.php" method="POST">
            <h3>Add New Supplier</h3>

            <input type="hidden" name="supplier_id" class="form-input">

            <div class="input-group">
                <label for="name">Full Name</label>
                <input class="form-input" id="name" type="text" name="name" placeholder="Jhon Doe" value="<?= $old_name ?>">
                <small>
                    <?= $name_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="email">E-Mail</label>
                <input class="form-input" id="email" type="email" name="email" placeholder="jhondoe@example.com" value="<?= $old_email ?>">
                <small>
                    <?= $email_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="number">Phone Number</label>
                <input class="form-input" id="number" type="tel" name="phoneNumber" placeholder="0623453445" value="<?= $old_number ?>">
                <small>
                    <?= $number_error_message ?>
                </small>
            </div>

            <div class="input-group">
                <label for="data">Registration Date</label>
                <input class="form-input" type="date" name="date" value="<?= $old_date ?>">
            </div>

            <div class="btns">
                <button id="cancel-btn" class="cancel-btn" type="button">Cancel</button>
                <button class="submit-btn" type="submit">Save</button>
            </div>
        </form>
    </div>

    <!-- form for deleting an element from the table -->
    <div id="delete-form-container" class="delete-form-container">
        <form action="../../../controllers/SupplierController.php" method="post" id="delete-form" class="delete-form">
            <p class="delete-message">Are you sure you want to delete this supplier permanently?</p>
            <input type="hidden" name="supplier_id" id="id" value="">
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