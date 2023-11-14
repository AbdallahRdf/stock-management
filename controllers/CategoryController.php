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

// this function creates an alert session varaible 
function create_alert_session_variable($variable_name, $message)
{
    $_SESSION["alert"] = true;
    $_SESSION[$variable_name] = $message;
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    if(isset($_POST["name"]))
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
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!");
    }
    else if(isset($_POST["category_id"]))
    {

        $category_id = $_POST["category_id"];

        $result = Category::delete_category($category_id);

        if($result === null) // if ther is products that are under this category then do not delete it;
        {
            create_alert_session_variable("deleting_fails_alert", "Can't delete this record");
        }
        else
        {
            create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
        }
    }
}

$_SESSION["categories"] = Category::all(); // get all the categories;

//* redirect to categories page;
header("Location: ../resources/views/pages/categories/index.php");
die();
