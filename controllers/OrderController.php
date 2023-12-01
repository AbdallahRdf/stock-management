<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Client;
use App\Models\Order;

session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/orders.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($date, $client)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    // Date validation                               
    if (!strtotime($date)) {
        $ERRORS["date_error"] = "Invalid Date";
    }
    //Client validation
    if (!preg_match("/^[0-9]+$/", $client)) {
        $ERRORS["client_error"] = "Invalid Client";
    }


    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_date"] = $date;
        $OLD["old_client"] = $client;

        // send back the error messages and the old input
        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["order_id"] == "") // create an order:
    {
        $date = $_POST["date"];
        $client = $_POST["client_id"];
        handle_inputs_validation($date, $client);
        Order::create($date, $client);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert
    } else if (!isset($_POST["date"]) && $_POST["order_id"] != "") // delete an order:
    {
        $result = Order::delete($_POST["order_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["date"]) && $_POST["order_id"] != "") // updating an order
    {
        $id = $_POST["order_id"];
        $date = $_POST["date"];
        $client_id = $_POST["client_id"];

        Order::update($id, $date, $client_id);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["clients"] = Client::all(); // get all the client;
$_SESSION["orders"] = Order::paginate(); // get all the client;


//* redirect to clients page;
goback();
