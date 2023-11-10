<?php
require_once "../../../app/util/functions.php";

session_start();
if (!isset($_SESSION['user'])) // if not logged in redirect back to login page
{
    view('auth.index');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoSync - Categories</title>
    <link rel="stylesheet" href="../../styles/sidebar.css">
    <link rel="stylesheet" href="../../styles/table.css">
</head>

<body>
    <div class="container">
        <?php require_once "../components/sidebar.php"; ?>

        <main class="main">
            <table>
                <thead>
                    <th class="py-20">Category Name</th>
                    <th class="py-20">Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <td>printers</td>
                        <td>
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Hard Discs</td>
                        <td>
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Laptops</td>
                        <td>
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Desktops</td>
                        <td>
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Laptops</td>
                        <td>
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="last">Desktops</td>
                        <td class="actions-td last">
                            <button class="modify-btn">
                                <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                            </button>
                            <button class="delete-btn">
                                <img src="../../img/delete.svg" alt="delete-icon">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>

</html>