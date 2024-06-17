<?php
session_start();
require_once("./includes/dbh.inc.php");

// Check if he enters with a session, and not by typing the url
if (!empty($_SESSION['authenticated']) && $_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the user
    $userID = $_SESSION["userID"];
    $bookID = $_GET["bookID"];


    // Check if his membership still running
    $queryISMember = "SELECT membership_expire_date FROM customers WHERE customers.IDC = :userID";
    $stmtIsMember = $pdo->prepare($queryISMember);
    $stmtIsMember->bindParam(':userID', $userID);
    $stmtIsMember->execute();
    $member = $stmtIsMember->fetch(PDO::FETCH_ASSOC);
    $currentDate = date("Y-m-d");
    if ($member['membership_expire_date'] < $currentDate) {
        // If his membership is over, update the membership to 0
        $queryRemoveMembership = "UPDATE customers
        SET membership = 0, membership_expire_date = NUll
        WHERE IDC = :userID";
        $stmtRemoveMembership = $pdo->prepare($queryRemoveMembership);
        $stmtRemoveMembership->bindParam(':userID', $userID);
        $stmtRemoveMembership->execute();

    }

    // Get the membership value
    $queryMembership = "SELECT  membership
        FROM customers WHERE IDC = $userID;";
    $result = $pdo->query($queryMembership);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $isMemeber = $row["membership"];

    //  If he isn't a member redirect to membership_reg
    if ($isMemeber == 0) {
        header("Location: ./membership_reg.php?bookID=" . urlencode($bookID));
        exit();

        // If he is a member, let him in to the borrow page and continue
    } elseif ($isMemeber == 1) {
        $queryBook = "SELECT * FROM books WHERE books.ID = :bookID;";
        $stmtBook = $pdo->prepare($queryBook);
        $stmtBook->bindParam(':bookID', $bookID);
        $stmtBook->execute();
        $book = $stmtBook->fetch(PDO::FETCH_ASSOC);

        // Get book info 
        $bookDep = $book["IDdepartement"];
        $bookName = $book['Name'];
        $bookAuthor = $book['Author'];
        $bookQuantity = $book['quantity'];

    }

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
    <title>ReadToWin Borrow a Book</title>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/borrow/borrow.css">
    <link rel="stylesheet" href="./css/borrow/borrow_media.css">
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
                        </span></h4>
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
                <div class="label">Stock</div>
                <div class="value">
                    <?= $bookQuantity ?>
                </div>
            </div>
        </div>
        <div class="right-side">
            <p>Interesting book?</p>
            <form action="./includes/borrow_handler.php" method="POST">
                <label for="email">Email</label>
                <div class="wrap-input">
                    <input type="email" id="email" name="email" placeholder="Enter email here" required autofocus>
                </div>
                <label for="password">Password</label>
                <div class="wrap-input">
                    <input type="password" id="password" name="pwd" placeholder="Enter password here" required>
                </div>

                <input type="hidden" name="bookID" value="<?= $bookID ?>">
                <input type="hidden" name="bookDep" value="<?= $bookDep ?>">
                <button type="submit">Borrow</button>
            </form>
            <div class="error-message">
                <?= $errorType ?>
            </div>
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