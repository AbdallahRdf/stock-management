<?php 

    include "../../util/functions.php";

    session_start();

    //* placeholder for signup errors;
    $signup_errors = false;
    $firstName_error = "";
    $lastName_error = "";
    $signup_email_error = "";
    $signup_password_error = "";
    
    //* if there is signup errors, assign to each vartiable its error message;
    if(isset($_SESSION['signup_errors'])){
        $signup_errors = true;
        $firstName_error = $_SESSION["signup_errors"]['firstName_error'];
        $lastName_error = $_SESSION["signup_errors"]['lastName_error'];
        $signup_email_error = $_SESSION["signup_errors"]['email_error'];
        $signup_password_error = $_SESSION["signup_errors"]['signup_password_error'];    
    }

    //* placeholder for signup errors;
    $login_errors = false;
    $login_email_error = "";
    $login_password_error = "";

    //* if there is signup errors, assign to each vartiable its error message;
    if (!empty($_SESSION) && isset($_SESSION['login_errors'])) {
        $login_errors = true;
        $login_email_error = $_SESSION['login_errors']['email_error'];
        $login_password_error = $_SESSION['login_errors']['login_password_error'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link rel="stylesheet" href="../styles/formsStyle.css">
</head>
<body>
    <div class="form-container">
        <!-- buttons to show form -->
        <div class="control-btns">
            <button class="control-btn <?= $signup_errors ? "selected-control-btn" : "unselected-control-btn" ?>" id="signup">Sign Up</button>
            <button class="control-btn <?= $signup_errors ? "unselected-control-btn" : "selected-control-btn" ?>" id="login">Log In</button>
        </div>
        <!-- Log in part -->
        <div id="loginPart" class="<?= $signup_errors ? "d-hidden" : "" ?>">
            <h1>Welcome Back!</h1>
            <form action="../../Controllers/AuthentificationController.php" method="post">

                <input type="hidden" name="login" value="login">

                <div class="input-group">
                    <input class="login-input" type="email" name="email" id="email" placeholder="E-Mail Address">
                    <small><?= $login_email_error ?></small>
                </div>

                <div class="input-group">
                    <input class="login-input" type="password" name="password" id="password" placeholder="Password">
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
            <form action="../../Controllers/AuthentificationController.php" method="post">

                <input type="hidden" name="signup" value="signup">

                <div class="input-group-group">

                    <div id="no-margin" class="input-group">
                        <input class="signup-input" type="text" name="firstName" id="fistName" placeholder="First Name">

                        <small><?= $firstName_error ?></small>
                    </div>

                    <div id="no-margin" class="input-group">
                        <input class="signup-input" type="text" name="lastName" id="lastName" placeholder="Last Name">

                        <small><?= $lastName_error ?></small>
                    </div>

                </div>

                <div class="input-group">
                    <input class="signup-input" type="email" name="email" id="email"  placeholder="E-Mail Address">

                    <small><?= $signup_email_error ?></small>
                </div>

                <div class="input-group">
                    <input class="signup-input" type="password" name="password" id="password" placeholder="Password">

                <small><?= $signup_password_error ?></small>                    
                </div>

                <div class="submit-btn">
                    <button type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/formsScript.js"></script>
</body>
</html>