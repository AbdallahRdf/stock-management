<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use App\Models\User;

require_once "../app/util/functions.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $errors = []; // will hold error message

    if(isset($_POST["oldPassword"])) // update password;
    {
        // get the input values
        $old_password = $_POST["oldPassword"];
        $new_password = $_POST["newPassword"];
        $new_password_confirm = $_POST["confirmPassword"];

        if(!password_verify($old_password, $_SESSION["user"]["password"])) // if the old password is not correct then:
        {
            $errors["oldPassword"] = "Old password is Incorrect";
        }

        $message = Validator::isPasswordValid($new_password); // test if the new password is valid

        if($message !== "valid") // if not:
        {
            $errors["newPassword"] = $message;
        }
        else if ($new_password !== $new_password_confirm) // else if the confirm password does not match the new password
        {
            $errors["confirmPassword"] = "Password does not match";
        }

        if(!empty($errors)) // if there is errors:
        {
            $_SESSION["errors"] = $errors;

            header("location: ../resources/views/pages/updatePassword.php");
            die();
        }
        $hash = password_hash($new_password, PASSWORD_DEFAULT); // hash the password
        User::update_password($_SESSION["user"]["id"], $hash); // update the password
        $_SESSION["user"]["password"] = $hash;
        create_alert_session_variable("updated_successfully_alert", "Password Updated successfully!");
    }
    else // update the information (first name, last name);
    {
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];

        $old = [];

        if (!Validator::isStrValid($first_name)) {
            $errors["firstName_error_message"] = "First Name is Invalid";
        }
        if (!Validator::isStrValid($last_name)) {
            $errors["lastName_error_message"] = "Last Name is Invalid";
        }
        if (!empty($errors)) {
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
        create_alert_session_variable("updated_successfully_alert", "Information Updated successfully!");
    }
}

header("location: ../resources/views/pages/settings.php");
die();