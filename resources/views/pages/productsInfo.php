<?php
require "../../../app/util/functions.php";
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

$product = $_SESSION["product"][0];

//dd($product);
?>

<!DOCTYPE html>
<html lang="en">

<!-- requiring <head> tag -->
<?php require_once "../commun/head.php"; ?>

<body>
    <!-- overlay -->
    <div id="nameoverlay" class="overlay"></div>

    <div class="container">
        <!-- sidebar -->
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">

            <!-- alert -->
            <?php require_once "../components/alert.php"; ?>

            <!-- card showing info -->
            <div class="product-container">
                <h1><?= $product['name'] ?></h1>
                <div class="element-grp">
                    <label for="description">Description : </label>
                    <p id="description"> <?= $product['description'] ?></p>
                </div>
                <div class="element-grp">
                    <label for="pprice"> Purchase Price : </label> <span id="pprice"><?= $product['purchase_price'] ?> </span>
                </div>
                <div class="element-grp">
                    <label for="sprice"> Selling Price : </label> <span id="sprice"><?= $product['selling_price'] ?> </span>
                </div>
                <div class="element-grp">
                    <label for="supplier"> Supplier : </label> <span id="supplier"><?= $product['supplier_name'] ?></span>
                </div>
                <div class="element-grp">
                    <label for="category"> Category : </label> <span id="category"><?= $product['category_name'] ?></span>
                </div>
                <div class="element-grp">
                    <label for="stock"> Stock Quantity : </label> <span id="stock"><?= $product['stock_quantity'] ?> </span>
                </div>

            </div>
        </div>

        <script src="../../js/sidebar.js"></script>
        <script src="../../js/alert.js"></script>
        <script src="../../js/dropdown.js"></script>
</body>

</html>