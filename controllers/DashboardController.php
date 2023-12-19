<?php

use App\Models\Category;
use App\Models\Client;
use App\Models\ClientOrder;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierOrder;

require_once "../app/util/functions.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

/**
 * @param array $min_year an array containing other array, each sub-array contains a year;
 * @return array return an array of years
 */
function format_years_array($min_year)
{
    $result = range((int)$min_year, date("Y")); // generate
    rsort($result);
    return $result;
}

session_start();

$_SESSION["client_count"] = number_format(count(Client::all())); // get the number of clients
$_SESSION["supplier_count"] = number_format(count(Supplier::all())); // get the number of suppliers
$_SESSION["category_count"] = number_format(count(Category::all())); // get the number of categories
$_SESSION["product_count"] = number_format(count(Product::all())); // get the number of products

$orders_oldest_year = ClientOrder::get_oldest_year()["min_year"] ?? date("Y"); // get the min year in the registration_date column of the clients order table
$supplier_orders_oldest_year = SupplierOrder::get_oldest_year()["min_year"] ?? date("Y"); // get the min year in the date column of the supplier order table

$_SESSION["orders_years_array"] = format_years_array(min($orders_oldest_year, $supplier_orders_oldest_year));
$_SESSION["clients_years_array"] = format_years_array(Client::get_oldest_year()["min_year"] ?? date("Y"));

$_SESSION["orders_data"] = ClientOrder::paginate();

header("location: ../resources/views/pages/dashboard.php");
die();
