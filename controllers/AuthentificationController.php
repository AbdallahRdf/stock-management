<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use Controllers\UserController;

// include "UserController.php";

require_once "../app/util/functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //* unsetting the previous signup errors and login errors
    session_start();
    unset($_SESSION["signup_errors"]);
    unset($_SESSION["login_errors"]);
    unset($_SESSION["old"]);
    
    // extracting the variable;
    extract($_POST);
    
    // array to hold error for login or singup
    $ERRORS = [];
    // will hold the old inputs value;
    $OLD = [];
    
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
        if (empty($firstName)) {
            $ERRORS["firstName_error"] = "First Name is required!";
        }
        else if (!Validator::isStrValid($firstName)) {
            $ERRORS["firstName_error"] = "Invalid First Name";
        } 

        // checking if the last name is valid
        if (empty($lastName)) {
            $ERRORS["lastName_error"] = "Last Name is required!";
        }
        else if (!Validator::isStrValid($lastName)) {
            $ERRORS["lastName_error"] = "Invalid Last Name";
        }

        // checking if the password is valid
        $isPasswordValid = Validator::isPasswordValid($password);
        if ($isPasswordValid !== "valid") {
            $ERRORS["signup_password_error"] = $isPasswordValid;
        }
    
        if (!empty($ERRORS)) {
            $ERRORS["signup_errors"] = true;

            $OLD["firstName"] = $firstName;
            $OLD["lastName"] = $lastName;
            $OLD["email"] = $email;

            $_SESSION['old'] = $OLD;
            $_SESSION['signup_errors'] = $ERRORS;

            view("auth.index");
            die();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        UserController::signup($firstName, $lastName, $email, $password);
        echo "done";
    }
    // checking if we are in a login process
    else if(isset($login))
    {
        if (!empty($ERRORS))
        {   
            $ERRORS["login_errors"] = true; // we have login errors
            $OLD["email"] = $email; // send back the email typed by the user
            
            $_SESSION['old'] = $OLD; // put the old inputs on session
            $_SESSION['login_errors'] = $ERRORS; // put the login errors messages on the session
            
            view("auth.index");
            die();
        }

        $should_user_be_logged = UserController::login($email, $password);

        if(!$should_user_be_logged)
        {
            $ERRORS["login_errors"] = true; // we have login errors
            $OLD["email"] = $email; // send back the email typed by the user

            $_SESSION['old'] = $OLD; // put the old inputs on session
            $_SESSION['login_errors'] = $ERRORS; // put the login errors messages on the session
            $_SESSION['alert'] = true; // show an alert if the email is not in the database or the password is incorrect;

            view("auth.index");
            die();
        }
        echo "done";
    }
    
} else {
    //* redirect to login page;
    view("auth.index");
}