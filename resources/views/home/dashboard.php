<?php
require_once "../../../app/util/functions.php";

session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    view('auth.index');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/sidebar.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <button id="toggle" value="hide">
                <img src="../../img/left-arrow-circle-svgrepo-com.svg" alt="left arrow">
            </button>
            <h2 class="toggled">InventoSync</h2>
            <div class="select-btns">
                <a href="#" class="select-btn icon-btn selected">
                    <img src="../../img/home.svg" alt="dashboard icon" title="Dashboard">
                    <span class="toggled">Dashboard</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/category.svg" alt="categories icon" title="Categories">
                    <span class="toggled">Categories</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/product.svg" alt="products icon" title="Products">
                    <span class="toggled">Products</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/client.svg" alt="client icon" title="Clients">
                    <span class="toggled">Clients</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/order.svg" alt="client icon" title="Orders">
                    <span class="toggled">Orders</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/supplier.svg" alt="supplier icon" title="Suppliers">
                    <span class="toggled">Suppliers</span>
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/supplier-orders.svg" alt="client icon" title="Supplier Orders">
                    <span class="toggled">Supplier Orders</span>
                </a>
                <a href="#" class="select-btn icon-btn logout-btn">
                    <img src="../../img/logout.svg" alt="logout icon" title="Log out">
                    <span class="toggled">Log out</span>
                </a>
            </div>
        </div>

        <div class="main">
            body
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>

</html>