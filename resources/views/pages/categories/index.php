<?php
session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    header('location: ../../auth/index.php');
}

$items = $_SESSION["categories"]; // items to be shown in the table

$table_header = ["Name", "Actions"]; // the title of the <th> tags

$error_message = ""; // for adding element form
$old_input_value = ""; // for the category name input in the add element form
$display_proprety = "none"; // if there is an error in the form then show the form again;
if (isset($_SESSION["error_message"])) // if there is an error after creating new element;
{
    $error_message = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);

    $old_input_value = $_SESSION['old'];
    unset($_SESSION["old"]);

    $display_proprety = "block";
}

$alert_message = "";
$alert_color_class = "";
$alert_display = "none";
if (isset($_SESSION["deleting_success_alert"])) // if the element is deleted successfully then:
{
    $alert_message = $_SESSION["deleting_success_alert"];
    unset($_SESSION["deleting_success_alert"]);
    $alert_color_class = "red-alert";
    $alert_display = "flex";
}
else if (isset($_SESSION["created_successfully_alert"]))
{
    $alert_message = $_SESSION["created_successfully_alert"];
    unset($_SESSION["created_successfully_alert"]);
    $alert_color_class = "green-alert";
    $alert_display = "flex";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Categories</title>
    <link rel="stylesheet" href="../../../styles/sidebar.css">
    <link rel="stylesheet" href="../../../styles/overlay.css">
    <link rel="stylesheet" href="../../../styles/table.css">
    <link rel="stylesheet" href="../../../styles/addingForm.css">
    <link rel="stylesheet" href="../../../styles/deleteForm.css">
    <link rel="stylesheet" href="../../../styles/alert.css">
</head>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <!-- sidebar -->
        <?php require_once "../../components/sidebar.php"; ?>

        <main class="main">

            <!-- alert -->
            <div id="alert" class="alert <?= $alert_color_class ?>" style="display:<?= $alert_display ?>">
                <?= $alert_message ?>
                <button id="dismiss-alert" class="dismiss-alert">X</button>
            </div>

            <!-- table -->
            <?php require_once "../../components/table.php"; ?>
        </main>
    </div>

    <!-- Form to add elements to the table -->
    <div id="adding-form-container" style="display:<?= $display_proprety ?>">
        <form id="form" class="form" action="../../../../controllers/CategoryController.php" method="POST">
            <h3>Create New Category</h3>
            <div class="input-group">
                <input type="text" name="name" placeholder="Category Name" value="<?= $old_input_value ?>">
                <small>
                    <?= $error_message ?>
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
        <form action="../../../../controllers/CategoryController.php" method="post" id="delete-form"
            class="delete-form">
            <p class="delete-message">Are you sure you want to delete it permanently?</p>
            <input type="hidden" name="category_id" id="category-id" value="">
            <div>
                <button type="button" id="delete-cancel" class="delete-cancel">Cancel</button>
                <button type="submit" class="delete-delete">Delete</button>
            </div>
        </form>
    </div>

    <script src="../../../js/sidebar.js"></script>
    <script src="../../../js/addingForm.js"></script>
    <script src="../../../js/deleteForm.js"></script>
    <script src="../../../js/alert.js"></script>
</body>

</html>