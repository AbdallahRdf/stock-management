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

        $name = $_POST["name"];
        $description = $_POST["description"];
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
        if(!is_float((float)$price))
        {
            $ERRORS["price_error"] = "Invalid Product Price";
        }
        if(!is_int($quantity))
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
}

$_SESSION["products"] = Product::all();
$_SESSION["categories"] = Category::all(); // get all the categories;

//* redirect to categories page;
header("Location: ../resources/views/pages/products.php");
die();