<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../util/functions.php";

//* requiring the autoloader
require_once "../autoloader/autoloader.php";

use App\Models\Client;
use App\Models\SupplierOrder;
use App\Models\Order;
use App\Models\OrderedProduct;

header('Content-Type: application/json'); // specify the content-type header of the response;

$chart = $_GET["chart"];
$year = $_GET["year"] ?? null;


// if there is a month missing in the data array, we put instead a zero value;
function formatOrdersChartData($data)
{
    if(!empty($data))
    {
        $formattedData = []; // will hold number of repetion of each month;

        $i = 0; // index of iteration;
        $month = 1; // number of month;
        while (count($formattedData) < 12) // if array contains less that 12 elements (months count);
        {
            if(isset($data[$i]))
            {
                if ($data[$i]["months"] == $month) // if the current element equals the current month
                {
                    array_push($formattedData, $data[$i]["count(id)"]); // then push it
                    $i++; // increment the $i
                } 
                else {
                    array_push($formattedData, 0); // if the current month is not in the array, then put 0 as its count
                }
                $month++; // increment the month
            } else {
                array_push($formattedData, 0);
                $i++;
            }
        }
        return $formattedData;
    }
    else
    {
        return [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
}

// this function handles formating Products chart data
function formatProductsChartData($data)
{
    $products_names = [];
    $products_quantities = [];

    for($i = 0; $i < count($data); $i++)
    {
        array_push($products_names, $data[$i]["name"]);
        array_push($products_quantities, $data[$i]["quantity"]);
    }

    return [$products_names, $products_quantities];
}

$view_model = [
    "ordersChart" => fn() => [formatOrdersChartData(Order::allGroupByMonth($year)), formatOrdersChartData(SupplierOrder::allGroupByMonth($year))],
    "topSellingProducts" => fn() => formatProductsChartData(OrderedProduct::get_top_selling_products()),
    "clientsChart" => fn() => formatOrdersChartData(Client::allGroupByMonth($year)),
];

echo json_encode($view_model[$chart]());
