<?php 

include "../util/functions.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    extract($_POST);
    
    $ERRORS = [];

    $firstName = trim($firstName);
    $lastName = trim($lastName);
    $email = trim($email);
    $password = trim($password);

    if(!isStrValid($firstName))
    {
        $ERRORS["firstName_error"] = "Invalid First Name";
    }
    else if(empty($firstName))
    {
        $ERRORS["firstName_error"] = "First Name is required!";
    }

    if(!isStrValid($lastName))
    {
        $ERRORS["lastName_error"] = "Invalid Last Name";
    }
    else if(empty($firstName))
    {
        $ERRORS["lastName_error"] = "Last Name is required!";
    }

    if(!isEmailValid($email))
    {
        $ERRORS["email_error"] = "Invalid Email Address";
    }

    $isPasswordValid = isPasswordValid($password);
    if($isPasswordValid !== "valid")
    {
        $ERRORS["password_error"] = $isPasswordValid;
    }

    if(!empty($ERRORS)){
        $ERRORS["signup_errors"] = true;

        view("index", $ERRORS);
        die();
    }
    echo "all is correct";  
    dd($ERRORS);
} else {

    view("index");
}