<?php
session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    header('location: ../../auth/index.php');
}

$items = $_SESSION['products'];

// the title of the <th> tags
$table_header = ["Name", "Discription", "Price", "Quantity", "Category", "Actions"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Products</title>
    <link rel="stylesheet" href="../../../styles/sidebar.css">
    <link rel="stylesheet" href="../../../styles/table.css">
</head>

<body>
    <div class="container">
        <?php require_once "../../components/sidebar.php"; ?>

        <main class="main">
            <?php require_once "../../components/table.php"; ?>
        </main>
    </div>

    <script src="../../../js/sidebar.js"></script>
</body>

</html>