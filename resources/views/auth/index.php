<?php

    include "../../../app/util/functions.php";

    session_start();

    //* placeholder for signup errors;
    $signup_errors = false;
    $firstName_error = "";
    $lastName_error = "";
    $signup_email_error = "";
    $signup_password_error = "";

    //* will hold the old values of the input
    $old_firstName = "";
    $old_lastName = "";
    $old_signup_email = "";

    //* will hold the old email of the login form
    $old_login_email = "";
    $show_alert = false; // show alert when there is a login error;
    
    //* if there is signup errors, assign to each variable its error message;
    if(isset($_SESSION['signup_errors'])){
        // errors
        $signup_errors = true;
        $firstName_error = $_SESSION["signup_errors"]['firstName_error'];
        $lastName_error = $_SESSION["signup_errors"]['lastName_error'];
        $signup_email_error = $_SESSION["signup_errors"]['email_error'];
        $signup_password_error = $_SESSION["signup_errors"]['signup_password_error'];

        // old inputs value
        $old_firstName = $_SESSION['old']['firstName'];
        $old_lastName = $_SESSION['old']['lastName'];
        $old_signup_email = $_SESSION['old']['email'];

        unset($_SESSION['signup_errors']);
    }
    
    //* if there is login errors, assign to each variable its error message;
    if (isset($_SESSION['login_errors'])) {
        // old inputs value
        $old_login_email = $_SESSION['old'];
        $show_alert = true;
        unset($_SESSION['login_errors']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
    <title>InventoSync</title>
    <link rel="stylesheet" href="../../styles/formsStyle.css">
</head>
<body>
    <div class="form-container">
        <div class="alert <?= $show_alert ? "" : "d-hidden" ?>">
            <button class="alert-dismiss">
                <img src="../../img/close.svg" alt="dismiss alert icon">
            </button>
            Incorrect username or password.
        </div>
        <!-- buttons to show form -->
        <div class="control-btns">
            <button class="control-btn <?= $signup_errors ? "selected-control-btn" : "unselected-control-btn" ?>" id="signup">Sign Up</button>
            <button class="control-btn <?= $signup_errors ? "unselected-control-btn" : "selected-control-btn" ?>" id="login">Log In</button>
        </div>
        <!-- Log in part -->
        <div id="loginPart" class="<?= $signup_errors ? "d-hidden" : "" ?>">
            <h1>Welcome Back!</h1>
            <form action="../../../controllers/AuthController.php" method="post">

                <div class="input-group">
                    <input 
                        class="login-input" 
                        type="email" 
                        name="email" 
                        placeholder="E-Mail Address" 
                        value="<?= $old_login_email ?>" 
                    >
                    <small><?= $login_email_error ?></small>
                </div>

                <div class="input-group">
                    <input class="login-input" type="password" name="password" placeholder="Password">
                    <small><?= $login_password_error ?></small>
                </div>

                <div class="submit-btn">
                    <button type="submit">Log In</button>
                </div>
            </form>
        </div>

        <!-- Sign up part -->
        <div id="signupPart" class="<?= $signup_errors ? "" : "d-hidden" ?>">
            <h1>Create Account</h1>
            <form action="../../../controllers/AuthController.php" method="post">

                <div class="input-group-group">

                    <div id="no-margin" class="input-group">
                        <input 
                            class="signup-input" 
                            type="text" 
                            name="first_name" 
                            placeholder="First Name"
                            value="<?= $old_firstName ?>" 
                        >

                        <small><?= $firstName_error ?></small>
                    </div>

                    <div id="no-margin" class="input-group">
                        <input 
                            class="signup-input" 
                            type="text" 
                            name="last_name" 
                            placeholder="Last Name"
                            value="<?= $old_lastName ?>"     
                        >

                        <small><?= $lastName_error ?></small>
                    </div>

                </div>

                <div class="input-group">
                    <input 
                        class="signup-input" 
                        type="email" 
                        name="email" 
                        placeholder="E-Mail Address"
                        value="<?= $old_signup_email ?>"
                    >

                    <small><?= $signup_email_error ?></small>
                </div>

                <div class="input-group">
                    <input class="signup-input" type="password" name="password" placeholder="Password">

                <small><?= $signup_password_error ?></small>                    
                </div>

                <div class="submit-btn">
                    <button type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../js/formsScript.js"></script>
</body>
</html>