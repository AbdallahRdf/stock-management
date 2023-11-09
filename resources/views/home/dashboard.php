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
    <link rel="stylesheet" href="../../styles/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>InventoSync</h2>
            <div class="select-btns">
                <a href="#" class="select-btn icon-btn selected">
                    <img src="../../img/home.svg" alt="dashboard icon">
                    Dashboard
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/category.svg" alt="categories icon">
                    Categories
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/product.svg" alt="products icon">
                    Products
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/client.svg" alt="client icon">
                    Clients
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/order.svg" alt="client icon">
                    Orders
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/supplier.svg" alt="supplier icon">
                    Suppliers
                </a>
                <a href="#" class="select-btn icon-btn">
                    <img src="../../img/supplier-orders.svg" alt="client icon">
                    Supplier Orders
                </a>
                <a href="#" class="select-btn icon-btn logout-btn">
                    <img src="../../img/logout.svg" alt="logout icon">
                    Log out
                </a>
            </div>
        </div>

        <div class="main">
            body
        </div>
    </div>
</body>

</html>