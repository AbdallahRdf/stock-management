<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\SupplierOrder;
use App\Models\Product;


session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/suppOrderedProducts.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($product, $quantity)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;


    if (!preg_match("/^[1-9]+[0-9]+$/", $quantity)) {
        $ERRORS["quantity_error"] = "Invalid Product Quantity";
    }

    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_product"] = $product;
        $OLD["old_quantity"] = $quantity;


        // send back the error messages and the old input
        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION["supplierOrderId"] = $_GET['info'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["supplierOrdered_p_id"] == "") { //create an ordered product
        $product = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $supplierOrder_id = $_SESSION["supplierOrderId"];
        //dd(['quantity' => $quantity, 'ordered_id' => $order_id, "product_id" => $product]);

        handle_inputs_validation($product, $quantity);

        SupplierOrder::createSupplierOrderedProduct($product, $quantity, $supplierOrder_id);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert


    } else if (!isset($_POST["quantity"]) && $_POST["supplierOrdered_p_id"] != "") // delete an SupplierOrdered product:
    {

        $result = SupplierOrder::deleteSupplierOrderedProduct($_POST["supplierOrdered_p_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["quantity"]) && $_POST["supplierOrdered_p_id"] != "") // updating an SupplierOrdered product
    {

        $supplierOrdered_p_id = $_POST["supplierOrdered_p_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        //dd(['quantity' => $quantity, 'supplierOrdered_p_id' => $supplierOrdered_p_id, "product_id" => $product_id]);

        handle_inputs_validation($product_id, $quantity);

        SupplierOrder::updateSupplierOrderedProduct($supplierOrdered_p_id, $product_id, $quantity);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["products"] = Product::all(); // get all the products
$_SESSION["supplierOrderedProducts"] = SupplierOrder::supplierOrderedProducts($_SESSION["supplierOrderId"]); // gets all the ordered ;
goback();