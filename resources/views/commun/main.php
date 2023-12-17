<!-- overlay -->
<div id="overlay" class="overlay"></div>

<div class="container">
    <!-- sidebar -->
    <?php require_once "../components/sidebar.php"; ?>

    <main class="main">

        <!-- alert -->
        <?php require_once "../components/alert.php"; ?>

        <!-- table -->
        <?php
        if (isset($products) && empty($products)) {
            require_once "../components/noProducts.php";
        } else {
            require_once "../components/table.php";
        }


        ?>
    </main>
</div>