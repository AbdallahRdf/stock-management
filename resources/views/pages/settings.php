<?php
require_once "../components/session_start.php"; // if not logged in redirect back to login page;
?>

<!DOCTYPE html>
<html lang="en">

<!-- requiring <head> tag -->
<?php require_once "../commun/head.php"; ?>

<body>
    <!-- overlay -->
    <div id="overlay" class="overlay"></div>

    <div class="container">
        <!-- sidebar -->
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">

            <!-- alert -->
            <?php require_once "../components/alert.php"; ?>

            <!-- card showing info -->
            <div class="settings-container">
                <h2>Your information</h2>

                <div class="input-grp">
                    <label for="firstName">First Name</label>
                    <input 
                        class="signup-input" 
                        type="text" 
                        placeholder="First Name" 
                        value="<?= $_SESSION["user"]["firstName"] ?>"
                        disabled
                    >
                </div>

                <div class="input-grp">
                    <label for="lastName">Last Name</label>
                    <input 
                        class="signup-input" 
                        type="text" 
                        placeholder="Last Name" value="<?= $_SESSION["user"]["lastName"] ?>"
                        disabled
                    >
                </div>


                <div class="input-grp">
                    <label for="email">E-Mail</label>
                    <input 
                        class="signup-input" 
                        type="email" 
                        placeholder="E-Mail Address"
                        value="<?= $_SESSION["user"]["email"] ?>"
                        disabled
                    >
                </div>
                <div class="btns">
                    <a href="updateSettings.php">Update information</a>
                    <a href="updatePassword.php">Update Password</a>
                </div>
            </div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/dropdown.js"></script>
</body>

</html>