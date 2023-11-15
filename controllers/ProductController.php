<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;
use App\Models\Product;

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST["product_id"] == "") // create a product:
    {
        $ERRORS = [];
        $OLD = [];

        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];

        if(!Validator::isStrValid($name))
        {
            $ERRORS["name_error"] = "Invalid Product Name";
        }
        if(!Validator::isStrValid($description))
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

        if(!empty($ERRORS))
        {
            $OLD["old_name"] = $name;
            $OLD["old_description"] = $description;
            $OLD["old_price"] = $price;
            $OLD["old_quantity"] = $quantity;
            $OLD["old_category"] = $category;

            $_SESSION["errors"] = $ERRORS;
            $_SESSION["old"] = $OLD;

            //* redirect to categories page;
            header("Location: ../resources/views/pages/products.php");
            die();
        }
        $result = Product::create($name, $description, $price, $quantity, $category);
    }
    else if (!isset($_POST["name"]) && $_POST["product_id"] != "")
    {
        $result = Product::delete($_POST["product_id"]);
    }
}

$_SESSION["products"] = Product::all();
$_SESSION["categories"] = Category::all(); // get all the categories;

//* redirect to categories page;
header("Location: ../resources/views/pages/products.php");
die();