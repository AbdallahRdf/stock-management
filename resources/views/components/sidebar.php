<?php
require_once "../../../app/util/functions.php";
$current_page = get_current_view();  // getting the name of the current view
?>

<div class="sidebar">
    <button id="toggle" class="toggle" value="visible">
        <img src="../../img/left-arrow-circle-svgrepo-com.svg" alt="left arrow">
    </button>
    <img class="logo toggled" src="../../img/logo.svg" alt="">
    <div class="select-btns">
        <a href="./dashboard.php"
            class="select-btn icon-btn toggled <?= $current_page === "dashboard" ? 'selected' : '' ?>">
            <img src="../../img/home.svg" alt="dashboard icon" title="Dashboard">
            Dashboard
        </a>
        <a href="../../../controllers/CategoryController.php"
            class="select-btn icon-btn toggled <?= $current_page === "categories" ? 'selected' : '' ?>">
            <img src="../../img/category.svg" alt="categories icon" title="Categories">
            Categories
        </a>
        <a href="../../../controllers/ProductController.php"
            class="select-btn icon-btn toggled <?= $current_page === "products" ? 'selected' : '' ?>">
            <img src="../../img/product.svg" alt="products icon" title="Products">
            Products
        </a>
        <a href="../../../controllers/ClientController.php"
            class="select-btn icon-btn toggled <?= $current_page === "clients" ? 'selected' : '' ?>">
            <img src="../../img/client.svg" alt="client icon" title="Clients">
            Clients
        </a>
        <a href="../../../controllers/OrderController.php" 
            class="select-btn icon-btn toggled <?= $current_page === "orders.php" ? 'selected' : '' ?>">
            <img src="../../img/order.svg" alt="client icon" title="Orders">
            Orders
        </a>
        <a href="../../../controllers/SupplierController.php"
            class="select-btn icon-btn toggled <?= $current_page === "suppliers" ? 'selected' : '' ?>">
            <img src="../../img/supplier.svg" alt="supplier icon" title="Suppliers">
            Suppliers
        </a>
        <a href="#" class="select-btn icon-btn toggled <?= $current_page === "" ? 'selected' : '' ?>">
            <img src="../../img/supplier-orders.svg" alt="client icon" title="Supplier Orders">
            Supplier Orders
        </a>
        <a id="dropdown"
            class="select-btn icon-btn user-btn toggled <?= ($current_page === "settings" || $current_page === "updateSettings" || $current_page === "updatePassword") ? 'selected' : '' ?>">
            <img src="../../img/user.svg" alt="logout icon" title="Log out">
            <?= "{$_SESSION["user"]["firstName"]} {$_SESSION["user"]["lastName"]}" ?>
        </a>
    </div>

    <!-- dropdown -->
    <div id="dropdown-card" class="dropdown" style="display: none" ;>
        <div>
            <a href="settings.php" class="dropdown-item icon-btn logout-btn toggled">
                <img src="../../img/settings.svg" alt="logout icon" title="Log out">
                Settings
            </a>
        </div>
        <hr>
        <div>
            <a id="logout-toggle" class="dropdown-item icon-btn logout-btn toggled">
                <img src="../../img/logout.svg" alt="logout icon" title="Log out">
                Log out
            </a>
        </div>
    </div>
</div>

<!-- logout confirmation box -->
<div class="logout-card-container" id="logout-card-container">
    <div id="logout-card" class="logout-card">
        <p class="logout-message">Are you sure you want to log out?</p>
        <div>
            <button id="logout-cancel" class="logout-cancel">Cancel</button>
            <a class="logout-logout" href="../../../controllers/AuthController.php">Log out</a>
        </div>
    </div>
</div>