<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\Supplier;
use Controllers\PersonController;

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") // did we get to this page through a post request
{
    if($_POST["supplier_id"] == "") // create a supplier:
    {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone_number = trim($_POST["phoneNumber"]);
        $date = $_POST["date"];

        PersonController::handle_inputs_validation($name, $email, $phone_number, $date, "suppliers");

        $result = Supplier::create([
            Supplier::FULL_NAME => $name,
            Supplier::EMAIL => $email, 
            Supplier::PHONE_NUM => $phone_number, 
            Supplier::REGISTRATION_DATE => $date
        ]);

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

        PersonController::handle_inputs_validation($name, $email, $phone_number, $date, "suppliers", $supplier_id);

        $result = Supplier::update($supplier_id, [
            Supplier::FULL_NAME => $name,
            Supplier::EMAIL => $email,
            Supplier::PHONE_NUM => $phone_number,
            Supplier::REGISTRATION_DATE => $date
        ]);

        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["suppliers"] = Supplier::paginate();

//* redirect to clients page;
header("Location: ../resources/views/pages/suppliers.php");
die();