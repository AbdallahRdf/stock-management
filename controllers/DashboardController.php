<?php

use App\Models\Category;
use App\Models\Client;
use App\Models\ClientOrder;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierOrder;

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

/**
 * @param array $array an array containing other array, each sub-array contains a year;
 * @return array return an array of years
 */
function format_years_array($array)
{
    return array_unique(array_map(fn($element) => $element["years"], $array));
}

session_start();

$_SESSION["client_count"] = number_format(count(Client::all())); // get the number of clients
$_SESSION["supplier_count"] = number_format(count(Supplier::all())); // get the number of suppliers
$_SESSION["category_count"] = number_format(count(Category::all())); // get the number of categories
$_SESSION["product_count"] = number_format(count(Product::all())); // get the number of products

$orders_years = ClientOrder::getAllYears(); // get the array of orders years wich contains each year in its own array
$supplier_orders_years = SupplierOrder::getAllYears(); // get the array of suppliers orders years wich contains each year in its own array

$_SESSION["orders_years_array"] = format_years_array([...$orders_years, ...$supplier_orders_years]);
$_SESSION["clients_years_array"] = format_years_array(Client::getAllYears());

$_SESSION["orders_data"] = ClientOrder::paginate();

header("location: ../resources/views/pages/dashboard.php");
die();
