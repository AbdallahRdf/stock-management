<?php
session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    header('location: ../auth/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Dashboard</title>
    <link rel="stylesheet" href="../../styles/sidebar.css">
</head>

<body>
    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">
            body
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>

</html>