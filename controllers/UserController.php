<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\User;

require_once "../app/util/functions.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];

    $errors = [];
    $old = [];
    
    if(!Validator::isStrValid($first_name))
    {
        $errors["firstName_error_message"] = "First Name is Invalid";
    }
     if(!Validator::isStrValid($last_name))
    {
        $errors["lastName_error_message"] = "Last Name is Invalid";
    }
    if(!empty($errors))
    {
        $old["old_firstName"] = $first_name;
        $old["old_lastName"] = $last_name;

        $_SESSION["old"] = $old;
        $_SESSION["errors"] = $errors;

        header("location: ../resources/views/pages/updateSettings.php");
        die();
    }
    User::update($_SESSION["user"]["id"], $first_name, $last_name);
    $_SESSION["user"]["firstName"] = $first_name;
    $_SESSION["user"]["lastName"] = $last_name;
}

header("location: ../resources/views/pages/settings.php");
die();