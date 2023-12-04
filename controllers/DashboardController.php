<?php

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

session_start();

$_SESSION["client_count"] = number_format(count(Client::all()));
$_SESSION["supplier_count"] = number_format(count(Supplier::all()));
$_SESSION["category_count"] = number_format(count(Category::all()));
$_SESSION["product_count"] = number_format(count(Product::all()));

header("location: ../resources/views/pages/dashboard.php");
die();
