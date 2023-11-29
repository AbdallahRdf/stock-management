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

header('Content-Type: application/json'); // specify the content-type header of the response;

$view = $_GET["viewName"];

if (isset($_GET["limit"]) && isset($_GET["offset"]))
{
    $limit = $_GET["limit"];
    $offset = $_GET["offset"];

    // an array mapping each view name with the model
    $views_models = [
        "categories" => fn() => Category::paginate($offset, $limit),
        "products" => fn() => Product::paginate($offset, $limit),
        "clients" => fn() => Client::paginate($offset, $limit),
        "suppliers" => fn() => Supplier::paginate($offset, $limit),
    ];
}
else
{
    // an array mapping each view name with the model
    $views_models = [
        "categories" => fn() => count(Category::all()),
        "products" => fn() => count(Product::all()),
        "clients" => fn() => count(Client::all()),
        "suppliers" => fn() => count(Supplier::all()),
    ];
}
echo json_encode($views_models[$view]());