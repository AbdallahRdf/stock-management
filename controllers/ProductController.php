<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;
use App\Models\Product;

session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/products.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($name, $description, $price, $quantity, $category, $id = null)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    if (!Validator::isAlphaNum($name)) {
        $ERRORS["name_error"] = "Invalid Product Name";
    }
    if (!Validator::isAlphaNum($description)) {
        $ERRORS["description_error"] = "Invalid Product Description";
    }
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $price)) {
        $ERRORS["price_error"] = "Invalid Product Price, If you include a decimal point, ensure there is at least one digit after it (e.g., 10, 10.99)";
    }
    if (!preg_match("/^[1-9]+[0-9]+$/", $quantity)) {
        $ERRORS["quantity_error"] = "Invalid Product Quantity";
    }

    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_name"] = $name;
        $OLD["old_description"] = $description;
        $OLD["old_price"] = $price;
        $OLD["old_quantity"] = $quantity;
        $OLD["old_category"] = $category;
        if ($id !== null) {
            $OLD["old_id"] = $id;
        }

        // send back the error messages and the old input
        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['info'])) {
    $id = $_GET['info'];
    $_SESSION["product"] = Product::getProduct($id); // get a specific product
    header("Location: ../resources/views/pages/productsInfo.php");
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["product_id"] == "") // create a product:
    {
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];

        handle_inputs_validation($name, $description, $price, $quantity, $category);

        // creating an excerpt of the description to show it in the table;
        $excerpt = substr($description, 0, 14) . "...";

        Product::create($name, $excerpt, $description, $price, $quantity, $category);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert
    } else if (!isset($_POST["name"]) && $_POST["product_id"] != "") // delete a product:
    {
        $result = Product::delete($_POST["product_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    } else if (isset($_POST["name"]) && $_POST["product_id"] != "") // updating a product
    {
        $product_id = $_POST["product_id"];
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];

        handle_inputs_validation($name, $description, $price, $quantity, $category, $product_id);

        // creating an excerpt of the description to show it in the table;
        $excerpt = substr($description, 0, 14) . "...";

        Product::update($product_id, $name, $excerpt, $description, $price, $quantity, $category);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}
$_SESSION["products"] = Product::paginate(); // get all the products
$_SESSION["categories"] = Category::all(); // get all the categories;
goback();
