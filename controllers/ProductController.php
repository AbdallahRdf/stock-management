<?php
require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;

session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to categories page;
    header("Location: ../resources/views/pages/products.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($name, $description, $purchase_price, $quantity, $category, $supplier, $selling_price, $id = null)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    if (!Validator::isAlphaNum($name)) {
        $ERRORS["name_error"] = "Invalid Product Name";
    }
    if (!Validator::isAlphaNum($description)) {
        $ERRORS["description_error"] = "Invalid Product Description";
    }
    if (!Validator::isDouble($purchase_price)) {
        $ERRORS["p_price_error"] = "Invalid Product Price, If you include a decimal point, ensure there is at least one digit after it (e.g., 10, 10.99)";
    }
    if (!Validator::isDouble($selling_price)) {
        $ERRORS["s_price_error"] = "Invalid Product Price, If you include a decimal point, ensure there is at least one digit after it (e.g., 10, 10.99)";
    }
    if (!Validator::isNumber($quantity)) {
        $ERRORS["quantity_error"] = "Invalid Product Quantity";
    }

    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_name"] = $name;
        $OLD["old_description"] = $description;
        $OLD["old_p_price"] = $purchase_price;
        $OLD["old_quantity"] = $quantity;
        $OLD["old_category"] = $category;
        $OLD["old_supplier"] = $supplier;
        $OLD["old_s_price"] = $selling_price;

        if ($id !== null) {
            $OLD["old_id"] = $id;
        }

        // send back the error messages and the old input

        $_SESSION["old"] = $OLD;
        $_SESSION["errors"] = $ERRORS;
        if (isset($_POST["supplierOrderId"])) {
            header("Location: ../resources/views/components/addProduct.php");
            die();
        }

        goback();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['info'])) // if it a get request, and $_GET["info"] does exist which is a product id, then:
{
    $_SESSION["product"] = Product::get_product($_GET['info']); // get a specific product
    header("Location: ../resources/views/pages/productsInfo.php");
    die();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["supplierOrderId"])) {
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $purchase_price = $_POST["purchase_price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];
        $supplier = $_POST["supplier"];
        $selling_price = $_POST["selling_price"];
        handle_inputs_validation($name, $description, $purchase_price, $quantity, $category, $supplier, $selling_price);
        $excerpt = substr($description, 0, 14) . "...";

        Product::create([
            Product::NAME => $name,
            Product::EXCERPT => $excerpt,
            Product::DESCRIPTION => $description,
            Product::PURCHASE_PRICE => $purchase_price,
            Product::STOCK_QUANTITY => $quantity,
            Product::CATEGORY_ID => $category,
            Product::SUPPLIER_ID => $supplier,
            Product::SELLING_PRICE => $selling_price
        ]);
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!"); // create an alert
        header("Location: ./SuppOrderedProdsController.php?info=" . $_POST["supplierOrderId"]);
        die();
    }
    if ($_POST["product_id"] == "") // create a product:
    {
        $name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $purchase_price = $_POST["purchase_price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];
        $supplier = $_POST["supplier"];
        $selling_price = $_POST["selling_price"];

        handle_inputs_validation($name, $description, $purchase_price, $quantity, $category, $supplier, $selling_price);

        // creating an excerpt of the description to show it in the table;
        $excerpt = substr($description, 0, 14) . "...";

        Product::create([
            Product::NAME => $name,
            Product::EXCERPT => $excerpt,
            Product::DESCRIPTION => $description,
            Product::PURCHASE_PRICE => $purchase_price,
            Product::STOCK_QUANTITY => $quantity,
            Product::CATEGORY_ID => $category,
            Product::SUPPLIER_ID => $supplier,
            Product::SELLING_PRICE => $selling_price
        ]);

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
        $purchase_price = $_POST["purchase_price"];
        $quantity = $_POST["quantity"];
        $category = $_POST["category"];
        $supplier = $_POST["supplier"];
        $selling_price = $_POST["selling_price"];

        handle_inputs_validation($name, $description, $purchase_price, $quantity, $category, $supplier, $selling_price, $product_id);

        // creating an excerpt of the description to show it in the table;
        $excerpt = substr($description, 0, 14) . "...";

        Product::update($product_id, [
            Product::NAME => $name,
            Product::EXCERPT => $excerpt,
            Product::DESCRIPTION => $description,
            Product::PURCHASE_PRICE => $purchase_price,
            Product::STOCK_QUANTITY => $quantity,
            Product::CATEGORY_ID => $category,
            Product::SUPPLIER_ID => $supplier,
            Product::SELLING_PRICE => $selling_price
        ]);
        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}
$_SESSION["products"] = Product::paginate(); // get all the products
$_SESSION["categories"] = Category::all(); // get all the categories;
$_SESSION["suppliers"] = Supplier::all(); // get all the suppliers;
goback();
