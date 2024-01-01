<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Category;

session_start();

// this function handles when there is an error in the inputs;
function handle_form_errors($category_name, $message, $id = null)
{
    $_SESSION['error_message'] = $message;
    $_SESSION["old_category"] = $category_name;
    if($id !== null){
        $_SESSION["old_id"] = $id;
    }

    //* redirect to categories page;
    header("Location: ../resources/views/pages/categories.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{   
    if(isset($_POST["name"]) && $_POST["category_id"]==="") // create an element:
    {
        $category_name = $_POST["name"];
    
        if(!Validator::isAlphaNum($category_name))
        {
            handle_form_errors($category_name, "Invalid Category Name");
        }
        // create the new category
        $result = Category::create([Category::NAME => $category_name]);

        // if the category already exists in db;
        if($result === null)
        {
            handle_form_errors($category_name, "Category already exists");
        }
        create_alert_session_variable("created_successfully_alert", "Record Created successfully!");
    }
    else if(isset($_POST["category_id"]) && isset($_POST["name"])) // update an element:
    {
        $category_name = $_POST["name"];
        $category_id = $_POST["category_id"];

        if (!Validator::isAlphaNum($category_name)) {
            handle_form_errors($category_name, "Invalid Category Name", $category_id);
        }
        $result = Category::update($category_id, $category_name);

        // if the category already exists in db;
        if ($result === null) {
            handle_form_errors($category_name, "Category already exists", $category_id);
        }
        create_alert_session_variable("updated_successfully_alert", "Record Updated Successfully!");
    }
    else if(isset($_POST["category_id"])) // delete an element:
    {

        $category_id = $_POST["category_id"];

        $result = Category::delete($category_id);

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

$_SESSION["categories"] = Category::paginate(); // get categories;

//* redirect to categories page;
header("Location: ../resources/views/pages/categories.php");
die();
