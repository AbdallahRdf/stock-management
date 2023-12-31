<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\Supplier;
use App\Models\SupplierOrder;

session_start();
// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/supplierOrders.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($date, $supplier, $id = null)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    // Date validation                               
    if (!strtotime($date)) {
        $ERRORS["date_error"] = "Invalid Date";
    }

    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_date"] = $date;
        $OLD["old_supplier"] = $supplier;
        if ($id != null) $OLD["old_id"] = $id;
        // send back the error messages and the old input
        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["supplierOrder_id"] == "") // create an order:
    {
        $date = $_POST["date"];
        $supplier = $_POST["supplier_id"];
        handle_inputs_validation($date, $supplier);
        SupplierOrder::create([
            SupplierOrder::DATE => $date, 
            SupplierOrder::TRADE_PARTNER_ID => $supplier
        ]);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert
    } else if (!isset($_POST["date"]) && $_POST["supplierOrder_id"] != "") // delete an SupplierOrder:
    {
        $result = SupplierOrder::delete($_POST["supplierOrder_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["date"]) && $_POST["supplierOrder_id"] != "") // updating an order
    {
        $id = $_POST["supplierOrder_id"];
        $date = $_POST["date"];
        $supplier_id = $_POST["supplier_id"];
        handle_inputs_validation($date, $supplier_id, $id);

        SupplierOrder::update($id, $date, $supplier_id);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["suppliers"] = Supplier::all(); // get all the suppliers;
$_SESSION["supplierOrders"] = SupplierOrder::paginate(); // get all the supplier orders;


//* redirect to clients page;
goback();
