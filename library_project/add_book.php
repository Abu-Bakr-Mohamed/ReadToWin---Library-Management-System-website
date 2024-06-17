<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the url
if (!empty($_SESSION['authenticated'])) {


} else {
    // If the user got here using other way than a session, go back to staff_dashboard
    header("Location: ./staff_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToWin Edit Book</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/book_add/add_book.css">
    <link rel="stylesheet" href="./css/book_add/add_book_media.css">
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
        <p>ReadToWin Adding Books</p>
        <form action="./includes/add_book_handler.php" method="POST" enctype="multipart/form-data">
            <label for=" book-name">Book name</label>
            <div class="wrap-input">
                <input type="text" id="book-name" name="bookName" required autofocus placeholder="Enter book name">
            </div>

            <label for="author-name">Author name</label>
            <div class="wrap-input">
                <input type="text" id="author-name" name="authorName" required placeholder="Enter author name">
            </div>

            <label for="price">Price</label>
            <div class="wrap-input">
                <input type="number" id="price" min="0" name="price" step="0.01" required placeholder="Enter price">
            </div>

            <label for="quantity">Quantity</label>
            <div class="wrap-input">
                <input type="number" id="quantity" min="0" name="quantity" pattern="\d+" required
                    placeholder="Enter quantity">
            </div>

            <label for="departement">Departement</label>
            <select class="wrap-input" id="departement" name="departement" required>
                <option value="" disabled selected>Select a departement</option>
                <option value="1">Fiction</option>
                <option value="2">History</option>
                <option value="3">Mystery</option>
                <option value="4">Science</option>
            </select>
            <label for="image">Book Image</label>
            <div class="wrap-image">
                <input type="file" id="image" name="bookImage" accept="image/*" required>
                <label for="image"></label>
            </div>


            <button type="submit">Add book</button>
        </form>
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