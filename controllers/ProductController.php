<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\Product;

$products = Product::all();

session_start();
$_SESSION["products"] = $products;

//* redirect to categories page;
header("Location: ../resources/views/pages/products/index.php");
die();