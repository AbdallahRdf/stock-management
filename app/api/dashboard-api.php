<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../util/functions.php";

//* requiring the autoloader
require_once "../autoloader/autoloader.php";

use App\Models\SupplierOrder;
use App\Models\Order;

header('Content-Type: application/json'); // specify the content-type header of the response;

$model = $_GET["model"];
$year = $_GET["year"];


// if there is a month missing in the data array, we put instead a zero value;
function formatData($data)
{
    $formattedData = [];

    for ($i = 0; $i < 12; $i++) {
        if ($data[$i]["month(date)"] == $i + 1) {
            array_push($formattedData, $data[$i]["count(id)"]);
        } else {
            array_push($formattedData, 0);
        }
    }
    return $formattedData;
}

$models = [
    "ordersChart" => fn() => [formatData(Order::allGroupByMonth($year)), formatData(SupplierOrder::allGroupByMonth($year))],
];

echo json_encode($models[$model]());
