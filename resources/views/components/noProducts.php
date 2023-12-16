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
    <button id="add-btn"> <!-- button to add new elements to the table -->
        Add Product For <?= $supplier[0]['full_name'] ?>
    </button>

    <div id="adding-form-container" style="display:<?= $display_proprety1 ?>">
        <form id="form" class="form" action="../../../controllers/ProductController.php" method="POST">
            <h3>Add New Record</h3>
            <div class="inside-form-container">
                <div class="input-group">
                    <input type="hidden" name="product_id" class="form-input" value="<?= $old_id ?>">
                    <?php
                    if ($current_page == "suppOrderedProducts") {
                    ?>
                        <input type="hidden" name="supplierOrderId" value="<?= $supplierOrderId ?>">
                    <?php
                    }
                    ?>
                    <label for="name">Product Name</label>
                    <input class="form-input" id="name" type="text" name="name" placeholder="Product Name" value="<?= $old_name ?>">
                    <small>
                        <?= $name_error_message ?>
                    </small>
                </div>

                <div class="input-group">
                    <label for="description">Product Description</label>
                    <textarea name="description" id="description" class="form-input" cols="30" rows="5" placeholder="Product Description"><?= $old_email ?></textarea>
                    <small>
                        <?= $email_error_message ?>
                    </small>
                </div>

                <div class="input-group">
                    <label for="pprice">Purchase Price</label>
                    <input id="pprice" class="form-input" type="text" name="purchase_price" placeholder="Product Purchase Price" value="<?= $old_p_price ?>">
                    <small>
                        <?= $pprice_error_message ?>
                    </small>
                </div>


                <div class="input-group">
                    <label for="s_price">Selling Price</label>
                    <input id="s_price" class="form-input" type="text" name="selling_price" placeholder="Product Selling Price" value="<?= $old_s_price ?>">
                    <small>
                        <?= $sprice_error_message ?>
                    </small>
                </div>

                <div class="input-group">
                    <label for="quantity">Product Quantity</label>
                    <input class="form-input" id="quantity" type="number" min="0" name="quantity" placeholder="Product Quantity" value="<?= $old_date ?>">
                    <small>
                        <?= $date_error_message ?>
                    </small>
                </div>

                <div class="input-group">
                    <label for="supplier">The Product Supplier</label>
                    <div class="custom-select">
                        <select name="supplier" class="form-input" id="supplier" required>
                            <option value="" disabled selected>--Select an option--</option>
                            <option value="<?= $supplier[0]["id"] ?>" selected><?= $supplier[0]["full_name"] ?></option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="category">Select the product category</label>
                    <div class="custom-select">
                        <select name="category" class="form-input" id="category" required>
                            <option value="" disabled selected>--Select an option--</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category["id"] ?>" <?= (string) $category["id"] === (string) $old_category ? 'selected' : '' ?>>
                                    <?= $category["name"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="btns">
                    <button id="cancel-btn" class="cancel-btn" type="button">Cancel</button>
                    <button class="submit-btn" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>