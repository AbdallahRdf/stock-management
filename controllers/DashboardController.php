<?php

use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierOrder;

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

session_start();

$_SESSION["client_count"] = number_format(count(Client::all())); // get the number of clients
$_SESSION["supplier_count"] = number_format(count(Supplier::all())); // get the number of suppliers
$_SESSION["category_count"] = number_format(count(Category::all())); // get the number of categories
$_SESSION["product_count"] = number_format(count(Product::all())); // get the number of products

$orders_years = Order::getAllYears(); // get the array of orders years wich contains each year in its own array
$supplier_orders_years = SupplierOrder::getAllYears(); // get the array of suppliers orders years wich contains each year in its own array

// return only an array of years
$years = array_map(fn($element) => $element["(year(date))"] , [...$orders_years, ...$supplier_orders_years]);

$_SESSION["years_arrray"] = array_unique($years); // delete the duplicates

header("location: ../resources/views/pages/dashboard.php");
die();
