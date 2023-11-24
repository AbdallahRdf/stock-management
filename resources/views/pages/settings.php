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

    <?php require_once "../components/dropdown.php"; ?>

    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <div class="main">
            <div class="settings-container">
                <h2>Your information</h2>
                <form action="../../../controllers/UserController.php" method="post">

                    <div class="input-group-group">

                        <div class="input-grp">
                            <label for="firstName">First Name</label>
                            <input class="signup-input" id="firstName" type="text" name="firstName"
                                placeholder="First Name" value="<?= $_SESSION["user"]["firstName"] ?>">

                            <small>
                                <?= $firstName_error ?>
                            </small>
                        </div>

                        <div class="input-grp">
                            <label for="lastName">Last Name</label>
                            <input class="signup-input" id="lastName" type="text" name="lastName"
                                placeholder="Last Name" value="<?= $_SESSION["user"]["lastName"] ?>">

                            <small>
                                <?= $lastName_error ?>
                            </small>
                        </div>

                    </div>

                    <div class="input-grp">
                        <label for="email">E-Mail</label>
                        <input class="signup-input" id="email" type="email" name="email" placeholder="E-Mail Address"
                            value="<?= $_SESSION["user"]["email"] ?>">

                        <small>
                            <?= $signup_email_error ?>
                        </small>
                    </div>

                    <div >
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
    <script src="../../js/dropdown.js"></script>
</body>

</html>