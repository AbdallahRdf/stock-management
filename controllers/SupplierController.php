<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\Supplier;

session_start();

// this function redirects back to products page
function goback()
{
    //* redirect to clients page;
    header("Location: ../resources/views/pages/suppliers.php");
    die();
}

// this function checks if the inputs are valid if not then send back an error message
function handle_inputs_validation($name, $email, $phone_number, $date)
{
    $ERRORS = []; // will hold error messages
    $OLD = []; // will hold old inputs data when there is an error;

    if (!Validator::isStrValid($name)) {
        $ERRORS["name_error"] = "Invalid name";
    }
    if (!Validator::isEmailValid($email)) {
        $ERRORS["email_error"] = "Invalid email";
    }
    if (!preg_match("/^\d{10}$|^\d{3}-\d{3}-\d{4}$|^\(\d{3}\)\s?\d{3}-\d{4}$/", $phone_number)) {
        $ERRORS["number_error"] = "Invalid phone number";
    }
    if (!empty($ERRORS)) // if there is errors
    {
        $OLD["old_name"] = $name;
        $OLD["old_email"] = $email;
        $OLD["old_number"] = $phone_number;
        $OLD["old_date"] = $date;

        $_SESSION["errors"] = $ERRORS;
        $_SESSION["old"] = $OLD;

        goback();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") // did we get to this page through a post request
{
    if($_POST["supplier_id"] == "") // create a supplier:
    {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone_number = trim($_POST["phoneNumber"]);
        $date = $_POST["date"];

        $result = Supplier::create($name, $email, $phone_number, $date);

        create_alert_session_variable("created_successfully_alert", "Record Created successfully!");
    }
    else if (!isset($_POST["name"]) && $_POST["supplier_id"] != "") // delete a supplier:
    {
        $result = Supplier::delete($_POST["supplier_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    }
    else if (isset($_POST["name"]) && $_POST["supplier_id"] != "") // updating a supplier
    {
        $supplier_id = $_POST["supplier_id"];
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone_number = trim($_POST["phoneNumber"]);
        $date = $_POST["date"];

        $result = Supplier::update($supplier_id, $name, $email, $phone_number, $date);

        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["suppliers"] = Supplier::all();

//* redirect to categories page;
goback();