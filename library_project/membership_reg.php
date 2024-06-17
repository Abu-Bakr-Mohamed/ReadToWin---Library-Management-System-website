<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the url
if (!empty($_SESSION['authenticated'])) {
    $bookID = $_GET["bookID"];
    // Display error messages if there is any
    $errorType = isset($_GET['errorType']) ? $_GET['errorType'] : null;
} else {
    // If the user submitted the data using any other way, send him back to the landing page
    header("Location: ./main_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToWin Membership Registration</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/membership_reg.php/membership_reg.css">
    <link rel="stylesheet" href="./css/membership_reg.php/membership_med.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;0,900;0,1000;1,900;1,1000&display=swap"
        rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/all.min.css">
</head>

<body>
    <header>
        <div class="logo"><span>Read</span>ToWin</div>
        <form id="logoutForm" action="./includes/logout_handler.php" method="GET">
            <button type="button" onclick="confirmLogout()">Logout</button>
        </form>
    </header>
    <main>
        <p>Wanna be a member?</p>
        <form action="./includes/membership_reg_handler.php" method="POST">
            <label for="email">Email</label>
            <div class="wrap-input">
                <input type="email" id="email" name="email" required autofocus placeholder="Enter email">
            </div>
            <label for="password">Password</label>
            <div class="wrap-input">
                <input type="password" id="password" name="pwd" required placeholder="Enter password">
            </div>
            <label for="credit">Credit number</label required>
            <div class="wrap-input">
                <input type="text" id="credit" placeholder="Enter credit number">
            </div>

            <input type="hidden" name="bookID" value="<?= $bookID ?>">
            <button type="submit">Submit</button>
        </form>
        <div class="error-message">
            <?= $errorType ?>
        </div>
    </main>
    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // If the user confirms, submit the form
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</body>

</html>