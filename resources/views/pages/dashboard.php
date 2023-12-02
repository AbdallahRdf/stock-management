<?php
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$cards_data = [
    [
        "card_title" => "Clients Count",
        "card_count" => "2,480",
        "card_icon" => "client-count.svg",
        "color" => "#4F73DE"
    ],
    [
        "card_title" => "Suppliers Count",
        "card_count" => "28",
        "card_icon" => "supplier-count.svg",
        "color" => "#1FC88C"
    ],
    [
        "card_title" => "Categories Count",
        "card_count" => "124",
        "card_icon" => "category-count.svg",
        "color" => "#36B9CB"
    ],
    [
        "card_title" => "Products Count",
        "card_count" => "1,324",
        "card_icon" => "products-count.svg",
        "color" => "#F5C138"
    ],
];
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
    <link rel="stylesheet" href="../../styles/dropdown.css">
    <link rel="stylesheet" href="../../styles/dashboard.css">
</head>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">
            <h2>Dashboard</h2>
            <div class="cards">
                <?php foreach($cards_data as $card): ?>
                    <div class="card" style="border-left-color: <?= $card["color"] ?>">
                        <div class="card-text">
                            <p style="color: <?= $card["color"] ?>"><?= $card["card_title"] ?></p>
                            <h3><?= $card["card_count"] ?></h3>
                        </div>
                        <div>
                            <img src="../../img/<?= $card["card_icon"] ?>" alt="client icon">
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/dropdown.js"></script>
</body>

</html>