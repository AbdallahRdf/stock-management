<?php
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

// show error message if there is invalid input values;
$old_password_error = $_SESSION["errors"]["oldPassword"] ?? "";
$new_password_error = $_SESSION["errors"]["newPassword"] ?? "";
$confirm_password_error = $_SESSION["errors"]["confirmPassword"] ?? "";
unset($_SESSION["errors"]);
?>

<!DOCTYPE html>
<html lang="en">

<!-- requiring <head> tag -->
<?php require_once "../commun/head.php"; ?>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- requiring the dropdown that contains the settings and logout -->
    <?php require_once "../components/dropdown.php"; ?>

    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">
            <div class="settings-container">
                <h2>Update your password</h2>
                <form action="../../../controllers/UserController.php" method="post">

                    <div class="input-group-group">

                        <div class="input-grp">
                            <label for="oldPassword">Old password</label>
                            <input 
                                class="signup-input" 
                                id="oldPassword" 
                                type="password" 
                                name="oldPassword"
                                placeholder="Old Password" 
                            >

                            <small class="error-message">
                                <?= $old_password_error ?>
                            </small>
                        </div>

                        <div class="input-grp">
                            <label for="newPassword">New Password</label>
                            <input 
                                class="signup-input" 
                                id="newPassword" 
                                type="password" 
                                name="newPassword"
                                placeholder="New Password" 
                                value="<?= $old_lastName ?>">

                            <small class="error-message">
                                <?= $new_password_error ?>
                            </small>
                        </div>

                        <div class="input-grp">
                            <label for="confirmPassword">Confirm Password</label>
                            <input 
                                class="signup-input" 
                                id="confirmPassword" 
                                type="password" 
                                name="confirmPassword"
                                placeholder="Confirm Password" 
                                value="<?= $old_lastName ?>">

                            <small class="error-message">
                                <?= $confirm_password_error ?>
                            </small>
                        </div>

                    </div>

                    <button type="submit">Update Password</button>
                </form>
            </div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/dropdown.js"></script>
</body>

</html>