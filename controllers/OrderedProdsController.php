<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Order;
use App\Models\Product;


session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/orderedProducts.php");
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
    $_SESSION["orderId"] = $_GET['info'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["ordered_p_id"] == "") { //create an ordered product
        $product = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        //$order_id = $_POST["orderId"];
        $order_id = $_SESSION["orderId"];
        //dd(['quantity' => $quantity, 'ordered_id' => $order_id, "product_id" => $product]);

        handle_inputs_validation($product, $quantity);

        Order::createOrderedProduct($product, $quantity, $order_id);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert


    } else if (!isset($_POST["quantity"]) && $_POST["ordered_p_id"] != "") // delete an ordered product:
    {
        $result = Order::deleteOrderedProduct($_POST["ordered_p_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["quantity"]) && $_POST["ordered_p_id"] != "") // updating an ordered product
    {
        $ordered_p_id = $_POST["ordered_p_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        //dd(['quantity' => $quantity, 'ordered_p_id' => $order_p_id, "product_id" => $product]);

        handle_inputs_validation($product_id, $quantity);

        Order::updateOrderedProduct($ordered_p_id, $product_id, $quantity);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["products"] = Product::all(); // get all the products
$_SESSION["orderedProducts"] = Order::orderedProducts($_SESSION["orderId"]); // gets all the ordered ;
goback();
