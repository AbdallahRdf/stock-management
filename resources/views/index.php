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
            <button class="control-btn unselected-control-btn" id="signup">Sign Up</button>
            <button class="control-btn selected-control-btn" id="login">Log In</button>
        </div>
        <!-- Log in part -->
        <div id="loginPart">
            <h1>Welcome Back!</h1>
            <form action="" method="post">
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="E-Mail Address">
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="submit-btn">
                    <button type="submit">Log In</button>
                </div>
            </form>
        </div>
        <!-- Sign up part -->
        <div id="signupPart" class="d-hidden">
            <h1>Create Account</h1>
            <form action="" method="post">
                <div class="input-group-group">
                    <div id="no-margin" class="input-group">
                        <input type="text" name="firstName" id="fistName" placeholder="First Name">
                    </div>
                    <div id="no-margin" class="input-group">
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                    </div>
                </div>
                <div class="input-group">
                    <input type="email" name="email" id="email"  placeholder="E-Mail Address">
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password">
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