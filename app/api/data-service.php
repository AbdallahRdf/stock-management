<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../util/functions.php";

//* requiring the autoloader
require_once "../autoloader/autoloader.php";

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ClientOrder;
use App\Models\OrderedProduct;
use App\Models\SupplierOrder;
use App\Models\SupplierOrderedProduct;

header('Content-Type: application/json'); // specify the content-type header of the response;


$view_name = $_GET["viewName"];

session_start();
$id = null;
if($view_name === "suppOrderedProducts")
{
    $id = $_SESSION["supplierOrderId"];
}
else if ($view_name === "orderedProducts")
{
    $id = $_SESSION["orderId"];
}

if (isset($_GET["limit"]) && isset($_GET["offset"]))
{
    $limit = $_GET["limit"];
    $offset = $_GET["offset"];

    // an array mapping each view name with the model
    $view_model = [
        "categories" => fn() => Category::paginate($offset, $limit),
        "products" => fn() => Product::paginate($offset, $limit),
        "clients" => fn() => Client::paginate($offset, $limit),
        "suppliers" => fn() => Supplier::paginate($offset, $limit),
        "orders" => fn() => ClientOrder::paginate($offset, $limit),
        "orderedProducts" => fn() => OrderedProduct::paginate($id, $offset, $limit),
        "supplierOrders" => fn() => SupplierOrder::paginate($offset, $limit),
        "suppOrderedProducts" => fn() => SupplierOrderedProduct::paginate($id, $offset, $limit),
    ];
}
else
{
    // an array mapping each view name with the model
    $view_model = [
        "categories" => fn() => count(Category::all()),
        "products" => fn() => count(Product::all()),
        "clients" => fn() => count(Client::all()),
        "suppliers" => fn() => count(Supplier::all()),
        "orders" => fn() => count(ClientOrder::all()),
        "orderedProducts" => fn() => count(OrderedProduct::all($id)),
        "supplierOrders" => fn() => count(SupplierOrder::all()),
        "suppOrderedProducts" => fn() => count(SupplierOrderedProduct::all($id)),
    ];
}
echo json_encode($view_model[$view_name]());