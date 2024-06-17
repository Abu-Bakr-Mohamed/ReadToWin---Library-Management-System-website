<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the url
if (!empty($_SESSION['authenticated']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Get book info
    $bookID = $_GET["bookID"];
    $queryBook = "SELECT * FROM books WHERE books.ID = :bookID;";
    $stmtBook = $pdo->prepare($queryBook);
    $stmtBook->bindParam(':bookID', $bookID);
    $stmtBook->execute();
    $book = $stmtBook->fetch(PDO::FETCH_ASSOC);
    // Save book info into variables 
    $bookDep = $book["IDdepartement"];
    $bookName = $book['Name'];
    $bookAuthor = $book['Author'];
    $bookQuantity = $book['quantity'];
    $bookPrice = $book['Price'];



} else {
    // If the user submitted the data using any other way, send him back to the landing page
    header("Location: ./staff_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToWin Edit a Book</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/book_edit/book_edit.css">
    <link rel="stylesheet" href="./css/book_edit/book_edit_media.css">
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
        <div class="left-side">
            <div class="book">
                <div class="book-image" style="background-image: url('<?= $book['image_path'] ?>')"
                    alt="<?= "Image not found" ?>">
                </div>
                <div class="book-info">
                    <h3>
                        <?= $book['Name'] ?>
                    </h3>
                    <h4>By: <span class="author-name">
                            <?= $book['Author'] ?>
                        </span>
                    </h4>
                </div>
            </div>
            <div class="full-book-info">
                <div class="label">Name</div>
                <div class="value" title="<?= $bookName ?>">
                    <?= $bookName ?>
                </div>
                <div class="label">ِAuthor</div>
                <div class="value">
                    <?= $bookAuthor ?>
                </div>
                <div class="label">Price</div>
                <div class="value">
                    <?= $bookPrice ?>$
                </div>
                <div class="label">Quantity</div>
                <div class="value">
                    <?= $bookQuantity ?>
                </div>
            </div>
        </div>
        <div class="right-side">
            <p>You can change one or both</p>
            <form action="./includes/edit_book_handler.php" method="POST">
                <label for="price">
                    Price ($)
                </label>
                <div class="wrap-input">
                    <input type="text" id="price" name="newPrice" placeholder="Enter new price">
                </div>
                <label for="quantity">
                    Quantity
                </label>
                <div class="wrap-input">
                    <input type="text" id="quantity" name="newQuantity" placeholder="Enter new quantity">
                </div>
                <input type="hidden" name="bookID" value="<?= $bookID ?>">
                <button type="submit">Update Details</button>
            </form>
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