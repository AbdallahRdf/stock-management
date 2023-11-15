<?php

require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$items = $_SESSION["categories"]; // items to be shown in the table;

$table_header = ["Name", "Actions"]; // the title of the <th> tags

$error_message = $_SESSION["error_message"] ?? ""; 
$old_input_value = $_SESSION['old'] ?? ""; 
$display_proprety = isset($_SESSION["error_message"]) ? "block" : "none"; // if there is an error in the form then show the form again;

if (isset($_SESSION["error_message"])) // if there is a session variable then unset it;
{
    unset($_SESSION["error_message"]);
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
        <form id="form" class="form" action="../../../controllers/CategoryController.php" method="POST">
            <h3>Create New Category</h3>
            <div class="input-group">
                <input type="hidden" name="category_id" class="form-input">
                <input class="form-input" type="text" name="name" placeholder="Category Name" value="<?= $old_input_value ?>">
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
        <form action="../../../controllers/CategoryController.php" method="post" id="delete-form"
            class="delete-form">
            <p class="delete-message">Are you sure you want to delete this record permanently?</p>
            <input type="hidden" name="category_id" id="id" value="">
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