<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$product = $_SESSION["product"][0];
?>

<!DOCTYPE html>
<html lang="en">

<!-- requiring <head> tag -->
<?php require_once "../commun/head.php"; ?>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <!-- sidebar -->
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">

            <!-- alert -->
            <?php //require_once "../components/alert.php"; ?>

            <!-- card showing info -->
            <div class="product-container">
                <div class="header">
                    <a href="../../../controllers/ProductController.php">
                        <img src="../../img/arrow.svg" alt="">
                    </a>
                    <h2>
                        <?= htmlspecialchars($product['name']) ?>
                    </h2>
                </div>
                <div class="element-grp">
                    <label for="description">Description: </label>
                    <textarea id="description" rows="6" disabled>
                        <?= htmlspecialchars($product['description']) ?>
                    </textarea>
                </div>
                <div class="element-grp">
                    <label for="pprice"> Purchase Price: </label>
                    <input type="text" id="pprice" value="<?= htmlspecialchars($product['purchase_price']) ?>" disabled>
                </div>
                <div class="element-grp">
                    <label for="sprice"> Selling Price: </label>
                    <input type="text" id="sprice" value="<?= htmlspecialchars($product['selling_price']) ?>" disabled>
                </div>
                <div class="element-grp">
                    <label for="supplier"> Supplier: </label>
                    <input type="text" id="supplier" value="<?= htmlspecialchars($product['supplier_name']) ?>"
                        disabled>
                </div>
                <div class="element-grp">
                    <label for="category"> Category: </label>
                    <input type="text" id="category" value="<?= $product['category_name'] ?>" disabled>
                </div>
                <div class="element-grp">
                    <label for="stock"> Stock Quantity: </label>
                    <input type="text" id="stock" value="<?= $product['stock_quantity'] ?>" disabled>
                </div>

            </div>
        </div>

        <script src="../../js/sidebar.js"></script>
        <!-- <script src="../../js/alert.js"></script> -->
        <script src="../../js/dropdown.js"></script>
</body>

</html>