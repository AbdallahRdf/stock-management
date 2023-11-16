<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;
use App\Models\Product;

session_start();

// this function creates an alert session varaible 
function create_alert_session_variable($variable_name, $message)
{
    $_SESSION["alert"] = true;
    $_SESSION[$variable_name] = $message;
}

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/products.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST["product_id"] == "") // create a product:
    {
        $ERRORS = []; // will hold error messages
        $OLD = []; // will hold old inputs data when there is an error;

        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];

        if(!Validator::isAlphaNum($name))
        {
            $ERRORS["name_error"] = "Invalid Product Name";
        }
        if(!Validator::isAlphaNum($description))
        {
            $ERRORS["description_error"] = "Invalid Product Description";
        }
        if(!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $price))
        {
            $ERRORS["price_error"] = "Invalid Product Price, If you include a decimal point, ensure there is at least one digit after it (e.g., 10, 10.99)";
        }
        if(!preg_match("/^[1-9]+[0-9]+$/", $quantity))
        {
            $ERRORS["quantity_error"] = "Invalid Product Quantity";
        }

        if(!empty($ERRORS)) // if there is errors
        {
            $OLD["old_name"] = $name;
            $OLD["old_description"] = $description;
            $OLD["old_price"] = $price;
            $OLD["old_quantity"] = $quantity;
            $OLD["old_category"] = $category;

            $_SESSION["errors"] = $ERRORS;
            $_SESSION["old"] = $OLD;

            goback();
        }
        Product::create($name, $description, $price, $quantity, $category);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!");
    }
    else if (!isset($_POST["name"]) && $_POST["product_id"] != "")
    {
        $result = Product::delete($_POST["product_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    }
}

$_SESSION["products"] = Product::all();
$_SESSION["categories"] = Category::all(); // get all the categories;
goback();