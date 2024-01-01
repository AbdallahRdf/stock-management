<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\ClientOrderedProduct;
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
function handle_inputs_validation($product, $quantity, $id = null)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    if (!Validator::isNumber($quantity)) {
        $ERRORS["quantity_error"] = "Invalid Product Quantity";
    }

    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_product"] = $product;
        $OLD["old_quantity"] = $quantity;
        if ($id != null) $OLD["old_id"] = $id;
        // send back the error messages and the old input
        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") { // checks if the request method is GET ."when the user click on the info button in orders.php view
    $_SESSION["orderId"] = $_GET['info']; //stores the value of the id sent into the session.
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["ordered_p_id"] == "") { //create an ordered product
        $product = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $order_id = $_SESSION["orderId"];

        handle_inputs_validation($product, $quantity);
        ClientOrderedProduct::create([
            ClientOrderedProduct::PRODUCT_ID => $product,
            ClientOrderedProduct::QUANTITY => $quantity,
            ClientOrderedProduct::ORDER_ID => $order_id
        ]);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert
    } else if (!isset($_POST["quantity"]) && $_POST["ordered_p_id"] != "") // delete an ordered product:
    {
        $result = ClientOrderedProduct::delete($_POST["ordered_p_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["quantity"]) && $_POST["ordered_p_id"] != "") // updating an ordered product
    {
        $ordered_p_id = $_POST["ordered_p_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        handle_inputs_validation($product_id, $quantity, $ordered_p_id);

        ClientOrderedProduct::update($ordered_p_id, [
            ClientOrderedProduct::PRODUCT_ID => $product_id, 
            ClientOrderedProduct::QUANTITY => $quantity
        ]);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["products"] = Product::all(); // get all the products
$_SESSION["orderedProducts"] = ClientOrderedProduct::paginate(0, 10, $_SESSION["orderId"]); // gets all the ordered ;
goback();
