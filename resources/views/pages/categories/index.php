<?php
session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    header('location: ../../auth/index.php');
}

$items = $_SESSION["categories"];

// the title of the <th> tags
$table_header = ["Name", "Actions"];

$error_message = "";
$old_input_value = "";
$display_proprety = "none";
if(isset($_SESSION["error_message"]))
{
    $error_message = $_SESSION["error_message"];
    unset($_SESSION["error_message"]);

    $old_input_value = $_SESSION['old'];
    unset($_SESSION["old"]);

    $display_proprety = "block";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Categories</title>
    <link rel="stylesheet" href="../../../styles/sidebar.css">
    <link rel="stylesheet" href="../../../styles/table.css">
    <link rel="stylesheet" href="../../../styles/addingForm.css">
</head>

<body>
    <div class="container">
        <?php require_once "../../components/sidebar.php"; ?>

        <main class="main">
            <?php require_once "../../components/table.php"; ?>
        </main>
    </div>

    <div id="overlay" class="overlay" style="display:<?= $display_proprety ?>">
        <form id="form" class="form" action="../../../../controllers/CategoryController.php" method="POST">
            <h3>Create New Category</h3>
            <div class="input-group">
                <input type="text" name="name" placeholder="Category Name" value="<?= $old_input_value ?>">
                <small><?= $error_message ?></small>
            </div>
            <div class="btns">
                <button id="cancel-btn" class="cancel-btn" type="button">Cancel</button>
                <button class="submit-btn" type="submit">Save</button>
            </div>
        </form>
    </div>

    <script src="../../../js/sidebar.js"></script>
    <script src="../../../js/addingForm.js"></script>
</body>

</html>