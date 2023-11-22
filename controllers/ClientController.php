<?php

require_once "../app/util/functions.php";

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Models\Client;
use Controllers\PersonController;

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") // did we get to this page through a post request
{
    if($_POST["client_id"] == "") // create a client:
    {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone_number = trim($_POST["phoneNumber"]);
        $date = $_POST["date"];

        PersonController::handle_inputs_validation($name, $email, $phone_number, $date, "clients");

        $result = Client::create($name, $email, $phone_number, $date);

        create_alert_session_variable("created_successfully_alert", "Record Created successfully!");
    }
    else if (!isset($_POST["name"]) && $_POST["client_id"] != "") // delete a client:
    {
        $result = Client::delete($_POST["client_id"]);
        create_alert_session_variable("deleting_successfully_alert", "Record deleted successfully!");
    }
    else if (isset($_POST["name"]) && $_POST["client_id"] != "") // updating a client
    {
        $client_id = $_POST["client_id"];
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone_number = trim($_POST["phoneNumber"]);
        $date = $_POST["date"];

        PersonController::handle_inputs_validation($name, $email, $phone_number, $date, "clients");

        $result = Client::update($client_id, $name, $email, $phone_number, $date);

        create_alert_session_variable("updated_successfully_alert", "Record Updated successfully!");
    }
}

$_SESSION["clients"] = Client::all();

//* redirect to clients page;
header("Location: ../resources/views/pages/clients.php");
die();