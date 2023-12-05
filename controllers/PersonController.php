<?php

namespace Controllers;

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;

class PersonController
{
    // this function checks if the inputs are valid if not then send back an error message
    public static function handle_inputs_validation($name, $email, $phone_number, $date, $view, $id = null)
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
            if($id !== null){
                $OLD["old_id"] = $id;
            }

            $_SESSION["errors"] = $ERRORS;
            $_SESSION["old"] = $OLD;

            //* redirect to clients page;
            header("Location: ../resources/views/pages/{$view}.php");
            die();
        }
    }
}