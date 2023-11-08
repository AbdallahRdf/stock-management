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
    <title>Stock Management</title>
    <link rel="stylesheet" href="../../styles/formsStyle.css">
</head>
<body>
    <div class="form-container">
        <div class="alert <?= $show_alert ? "" : "d-hidden" ?>">
            <button class="alert-dismiss">
                <svg fill="#f44336" height="14px" width="14px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460.775 460.775" xml:space="preserve" stroke="#f44336"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55 c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55 c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505 c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55 l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719 c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"></path> </g></svg>
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
            <form action="../../../controllers/AuthentificationController.php" method="post">

                <input type="hidden" name="login" value="login">

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
            <form action="../../../controllers/AuthentificationController.php" method="post">

                <input type="hidden" name="signup" value="signup">

                <div class="input-group-group">

                    <div id="no-margin" class="input-group">
                        <input 
                            class="signup-input" 
                            type="text" 
                            name="firstName" 
                            placeholder="First Name"
                            value="<?= $old_firstName ?>" 
                        >

                        <small><?= $firstName_error ?></small>
                    </div>

                    <div id="no-margin" class="input-group">
                        <input 
                            class="signup-input" 
                            type="text" 
                            name="lastName" 
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