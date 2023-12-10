<?php
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$cards_data = [
    [
        "card_title" => "Clients Count",
        "card_count" => $_SESSION["client_count"],
        "card_icon" => "client-count.svg",
        "color" => "#4F73DE"
    ],
    [
        "card_title" => "Suppliers Count",
        "card_count" => $_SESSION["supplier_count"],
        "card_icon" => "supplier-count.svg",
        "color" => "#1FC88C"
    ],
    [
        "card_title" => "Categories Count",
        "card_count" => $_SESSION["category_count"],
        "card_icon" => "category-count.svg",
        "color" => "#36B9CB"
    ],
    [
        "card_title" => "Products Count",
        "card_count" => $_SESSION["product_count"],
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
    <script src="../../js/dashboard.js"></script>
</head>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">
            <h2>Dashboard</h2>

            <!-- cards -->
            <div class="cards">
                <?php foreach ($cards_data as $card): ?>
                    <div class="card" style="border-left-color: <?= $card["color"] ?>">
                        <div class="card-text">
                            <p style="color: <?= $card["color"] ?>">
                                <?= htmlspecialchars($card["card_title"]) ?>
                            </p>
                            <h3>
                                <?= htmlspecialchars($card["card_count"]) ?>
                            </h3>
                        </div>
                        <div>
                            <img src="../../img/<?= $card["card_icon"] ?>" alt="client icon">
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="d-flex">
                <!-- orders chart -->
                <div class="orders-chart">
                    <div class="chart-header">
                        <div class="chart-title">
                            Orders Overview
                        </div>
                        <div class="chart-year">
                            <select name="year" id="orders-year-select">
                                <?php if(count($_SESSION["orders_years_array"]) <= 0): ?>
                                    <option value=""><?= date("Y") ?></option>
                                <?php else: ?>
                                    <?php foreach ($_SESSION["orders_years_array"] as $year): ?>
                                        <option value="<?= $year ?>">
                                            <?= $year ?>
                                        </option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="orders-chart"></canvas>
                    </div>
                </div>

                <!-- client chart -->
                <div class="clients-chart">
                    <div class="chart-header">
                        <div class="chart-title">
                            Monthly Client Growth Chart
                        </div>
                        <div class="chart-year">
                            <select name="year" id="clients-year-select">
                                <?php if (count($_SESSION["clients_years_array"]) <= 0): ?>
                                    <option value="">
                                        <?= date("Y") ?>
                                    </option>
                                <?php else: ?>
                                    <?php foreach ($_SESSION["clients_years_array"] as $year): ?>
                                        <option value="<?= $year ?>">
                                            <?= $year ?>
                                        </option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="clients-chart"></canvas>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                
                <!-- most saled products of all time -->
                <div class="best-selling-products-chart">
                    <div class="best-selling-products-chart-title">
                        Top 5 best-selling products.
                    </div>
                    <div class="best-selling-products-chart-container">
                        <canvas id="best-selling-products-chart"></canvas>
                    </div>
                </div>

                <!-- table showing latest clients orders -->
                <div class="orders-table">
                    <div class="order-table-title">
                        Latest 10 Orders
                    </div>
                    <!-- <caption>Latest Orders</caption> -->
                    <table>
                        <thead>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Info</th>
                        </thead>
                        <tbody>
                            <?php if(count($_SESSION["orders_data"]) <= 0) : ?>
                                <tr>
                                    <td colspan="3">No Orders To Show</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($_SESSION["orders_data"] as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row["date"]) ?></td>
                                        <td><?= htmlspecialchars($row["client_name"]) ?></td>
                                        <td>
                                            <a href="../../../controllers/OrderedProdsController.php?info=<?= $row["id"] ?>" class="info-btn">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?> 
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/sidebar.js"></script>
    <script src="../../js/dropdown.js"></script>
    <script src="../../js/charts.js"></script>
</body>

</html>