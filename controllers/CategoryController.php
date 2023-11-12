<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;

session_start();

// this function handles when there is an error in the inputs;
function handle_form_errors($category_name, $message)
{
    $_SESSION['error_message'] = $message;
    $_SESSION["old"] = $category_name;

    //* redirect to categories page;
    header("Location: ../resources/views/pages/categories/index.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $category_name = $_POST["name"];

    if(!Validator::isStrValid($category_name))
    {
        handle_form_errors($category_name, "Invalid Category Name");
    }
    // create the new category
    $result = Category::create_category($category_name);

    // if the category already exists in db;
    if($result === null)
    {
        handle_form_errors($category_name, "Category already exists");
    }
}

$_SESSION["categories"] = Category::all();

//* redirect to categories page;
header("Location: ../resources/views/pages/categories/index.php");
die();
