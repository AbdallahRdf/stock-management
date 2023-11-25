<?php
require_once "../components/session_start.php"; // if not logged in redirect back to login page;

// show error message if there is invalid input values;
$firstName_error = $_SESSION["errors"]["firstName_error_message"] ?? "";
$lastName_error = $_SESSION["errors"]["lastName_error_message"] ?? "";
unset($_SESSION["errors"]);

// get the old values of the inputs, if there is non then show the default values;
$old_firstName = $_SESSION["old"]["old_firstName"] ?? $_SESSION["user"]["firstName"];
$old_lastName = $_SESSION["old"]["old_lastName"] ?? $_SESSION["user"]["lastName"];
unset($_SESSION["old"]);
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
                <h2>Update information</h2>
                <form action="../../../controllers/UserController.php" method="post">

                    <div class="input-group-group">

                        <div class="input-grp">
                            <label for="firstName">First Name</label>
                            <input 
                                class="signup-input" 
                                id="firstName" 
                                type="text" 
                                name="firstName"
                                placeholder="First Name" 
                                value="<?= $old_firstName ?>"
                            >

                            <small class="error-message">
                                <?= $firstName_error ?>
                            </small>
                        </div>

                        <div class="input-grp">
                            <label for="lastName">Last Name</label>
                            <input 
                                class="signup-input" 
                                id="lastName" 
                                type="text" 
                                name="lastName"
                                placeholder="Last Name" 
                                value="<?= $old_lastName ?>"
                            >

                            <small class="error-message">
                                <?= $lastName_error ?>
                            </small>
                        </div>

                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/dropdown.js"></script>
</body>

</html>