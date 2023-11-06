<?php

use Core\Validator;

require_once "../util/functions.php";
require_once "../Core/Validator.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    session_start();
    unset($_SESSION["signup_errors"]);
    unset($_SESSION["login_errors"]);

    // extracting the variable;
    extract($_POST);

    // array to hold error for login or singup
    $ERRORS = [];
    
    $email = trim($email);
    $password = trim($password);

    // checking if the email is valid
    if (empty($email)) {
        $ERRORS["email_error"] = "Email Address is required!";
    } else if (!Validator::isEmailValid($email)) {
        $ERRORS["email_error"] = "Invalid Email Address";
    }

    // checking if we are in a signup process
    if(isset($signup))
    {
        $firstName = trim($firstName);
        $lastName = trim($lastName);
    
        // checking if the first name is valid
        if (!Validator::isStrValid($firstName)) {
            $ERRORS["firstName_error"] = "Invalid First Name";
        } else if (empty($firstName)) {
            $ERRORS["firstName_error"] = "First Name is required!";
        }

        // checking if the last name is valid
        if (!Validator::isStrValid($lastName)) {
            $ERRORS["lastName_error"] = "Invalid Last Name";
        } else if (empty($firstName)) {
            $ERRORS["lastName_error"] = "Last Name is required!";
        }

        // checking if the password is valid
        $isPasswordValid = Validator::isPasswordValid($password);
        if ($isPasswordValid !== "valid") {
            $ERRORS["signup_password_error"] = $isPasswordValid;
        }
    
        if (!empty($ERRORS)) {
            $ERRORS["signup_errors"] = true;
            $_SESSION['signup_errors'] = $ERRORS;
            view("index");
            die();
        }
        echo "all is correct";
        dd($ERRORS);
    }
    // checking if we are in a login process
    else if(isset($login))
    {
        if (!empty($ERRORS)) {
            $ERRORS["login_errors"] = true;
            $_SESSION['login_errors'] = $ERRORS;
            view("index");
            die();
        }
        echo "all is correct";
        dd($ERRORS);
    }
    
} else {
    //* redirect to login page;
    view("index");
}