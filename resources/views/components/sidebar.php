<div class="sidebar">
    <button id="toggle" class="toggle" value="visible">
        <img src="../../img/left-arrow-circle-svgrepo-com.svg" alt="left arrow">
    </button>
    <img class="logo toggled" src="../../img/logo.svg" alt="">
    <div class="select-btns">
        <a href="./dashboard.php" class="select-btn icon-btn selected toggled">
            <img src="../../img/home.svg" alt="dashboard icon" title="Dashboard">
            Dashboard
        </a>
        <a href="../../../controllers/CategoryController.php" class="select-btn icon-btn toggled">
            <img src="../../img/category.svg" alt="categories icon" title="Categories">
            Categories
        </a>
        <a href="../../../controllers/ProductController.php" class="select-btn icon-btn toggled">
            <img src="../../img/product.svg" alt="products icon" title="Products">
            Products
        </a>
        <a href="#" class="select-btn icon-btn toggled">
            <img src="../../img/client.svg" alt="client icon" title="Clients">
            Clients
        </a>
        <a href="#" class="select-btn icon-btn toggled">
            <img src="../../img/order.svg" alt="client icon" title="Orders">
            Orders
        </a>
        <a href="#" class="select-btn icon-btn toggled">
            <img src="../../img/supplier.svg" alt="supplier icon" title="Suppliers">
            Suppliers
        </a>
        <a href="#" class="select-btn icon-btn toggled">
            <img src="../../img/supplier-orders.svg" alt="client icon" title="Supplier Orders">
            Supplier Orders
        </a>
        <a id="logout-toggle" class="select-btn icon-btn logout-btn toggled">
            <img src="../../img/logout.svg" alt="logout icon" title="Log out">
            Log out
        </a>
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