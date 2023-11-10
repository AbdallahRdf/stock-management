<?php
require_once "../../../app/util/functions.php";

session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    view('auth.index');
}

$items = $_SESSION["categories"];

// the title of the <th> tags
$table_header = ["Category Name", "Actions"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Categories</title>
    <link rel="stylesheet" href="../../styles/sidebar.css">
    <link rel="stylesheet" href="../../styles/table.css">
</head>

<body>
    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <main class="main">
            <?php require_once "../components/table.php"; ?>
        </main>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>

</html>