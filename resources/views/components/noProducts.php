<div class="noproduct-container">
    <div class="header">
        <a href="../../../controllers/SuppOrderController.php">
            <img src="../../img/arrow.svg" alt="">
        </a>
        <div>
            <h2>!! Opps ...</h2>
            <h3>There are no Products supplied by <?= $supplier[0]['full_name'] ?> </h3>
        </div>

    </div>
    <a class="add-product" href="../components/addProduct.php"> Add Product For <?= $supplier[0]['full_name'] ?></a>
</div>