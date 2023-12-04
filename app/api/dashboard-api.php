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
    if(!empty($data))
    {
        $formattedData = []; // will hold number of repetion of each month;

        $i = 0; // index of iteration;
        $month = 1; // number of month;
        while (count($formattedData) < 12) // if array contains less that 12 elements (months count);
        {
            if(isset($data[$i]))
            {
                if ($data[$i]["month(date)"] == $month) // if the current element equals the current month
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

$models = [
    "ordersChart" => fn() => [formatData(Order::allGroupByMonth($year)), formatData(SupplierOrder::allGroupByMonth($year))],
];

echo json_encode($models[$model]());
