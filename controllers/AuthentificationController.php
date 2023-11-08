<?php

//* requiring the autoloader
require_once "../app/autoloader/autoloader.php";

use App\Core\Validator;
use Controllers\UserController;

require_once "../app/util/functions.php";

//* function that handles a login error;
function handle_login_error($email)
{
    $_SESSION['old'] = $email; // send back the email;
    $_SESSION['login_errors'] = true; // declare that there is a login error;

    view("auth.index"); // go to the login page;
    die();
}

//* function that handles a signup error
function handle_signup_error($firstName, $lastName, $email, $ERRORS)
{
    $ERRORS["signup_errors"] = true; // declare that there is a signup error;

    // send back the old inputs data
    $OLD["firstName"] = $firstName;
    $OLD["lastName"] = $lastName;
    $OLD["email"] = $email;

    $_SESSION['old'] = $OLD;
    $_SESSION['signup_errors'] = $ERRORS;

    view("auth.index"); // go bakc to signup page;
    die();
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    //* unsetting the previous signup errors and login errors
    session_start();
    unset($_SESSION["signup_errors"]);
    unset($_SESSION["login_errors"]);
    unset($_SESSION["old"]);
    
    // extracting the variable;
    extract($_POST);
    
    $email = trim($email);
    $password = trim($password);
    
    // checking if we are in a signup process
    if(isset($signup))
    {
        // array to hold error for singup
        $ERRORS = [];
        // will hold the old inputs value;
        $OLD = [];

        $firstName = trim($firstName);
        $lastName = trim($lastName);

        // checking if the email is valid
        if (empty($email) || !Validator::isEmailValid($email))
        {
            $ERRORS["email_error"] = "Invalid Email Address";
        }
    
        // checking if the first name is valid
        if (empty($firstName) || !Validator::isStrValid($firstName))
        {
            $ERRORS["firstName_error"] = "Invalid First Name";
        } 

        // checking if the last name is valid
        if (empty($lastName) || !Validator::isStrValid($lastName))
        {
            $ERRORS["lastName_error"] = "Invalid Last Name";
        }

        // checking if the password is valid
        $isPasswordValid = Validator::isPasswordValid($password);
        if ($isPasswordValid !== "valid")
        {
            $ERRORS["signup_password_error"] = $isPasswordValid;
        }
    
        if (!empty($ERRORS)){
            handle_signup_error($firstName, $lastName, $email, $ERRORS);
        }

        $password = password_hash($password, PASSWORD_DEFAULT); // encrypting the user

        // $is_email_taken: if the email is alredy used by another user will contain false
        $is_email_taken = UserController::signup($firstName, $lastName, $email, $password);

        if ($is_email_taken) 
        {
            $ERRORS["email_error"] = "Email is invalid or already taken";
            handle_signup_error($firstName, $lastName, $email, $ERRORS);
        }
        echo "done";
    }
    // checking if we are in a login process
    else if(isset($login))
    {
        // checking if the email is valid
        if (empty($email) || !Validator::isEmailValid($email))
        {
            handle_login_error($email);
        }

        $should_user_be_logged = UserController::login($email, $password);

        if(!$should_user_be_logged)
        {
            handle_login_error($email);
        }

        echo "done";
    }
    
} else {
    //* redirect to login page;
    view("auth.index");
}