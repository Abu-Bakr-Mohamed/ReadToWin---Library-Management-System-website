<?php
session_start();
require_once("./dbh.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['authenticated'])) {
    // Retrieve user information from the session
    $userID = $_SESSION["userID"];
    $email = $_SESSION["email"];
    $pwd = $_SESSION["pwd"];

    // Get form data
    $currentDate = date("Y-m-d");
    $bookID = $_POST["bookID"];
    $bookDep = $_POST["bookDep"];
    $enteredEmail = $_POST["email"];
    $enteredPwd = $_POST["pwd"];

    // Check for empty email or password
    if (empty($enteredEmail) || empty($enteredPwd)) {
        header("Location: ../borrow.php");
        exit();
    }

    // Check if entered email and password doesn't match the session
    if ($enteredEmail != $email || $enteredPwd != $pwd) {
        header("Location: ../borrow.php?bookID=$bookID&errorType=Incorrect email or password!");
        exit();
    }

    // Check if the book is already borrowed
    $queryIsBorrowed = "SELECT Delivery_date FROM borrowing WHERE borrower_ID = :userID AND IDB = :bookID;";
    $stmtIsBorrowed = $pdo->prepare($queryIsBorrowed);
    $stmtIsBorrowed->bindParam(":userID", $userID);
    $stmtIsBorrowed->bindParam(":bookID", $bookID);
    $stmtIsBorrowed->execute();
    $deliveryDate = $stmtIsBorrowed->fetchColumn();

    if ($deliveryDate && $deliveryDate > $currentDate) {
        header("Location: ../main_page.php");
        exit();
    }

    // Calculate the delivery date (15 days from the current date)
    $Delivery_date = date("Y-m-d", strtotime($currentDate . " + 15 days"));

    // Insert borrowing record into the database
    $queryBorrow = "INSERT INTO borrowing (date, Delivery_date, IDB, IDDEP, borrower_ID) 
                    VALUES (:currentDate, :Delivery_date, :IDB, :IDDEP, :borrower_ID);";
    $stmtBorrow = $pdo->prepare($queryBorrow);
    $stmtBorrow->bindParam(":currentDate", $currentDate);
    $stmtBorrow->bindParam(":Delivery_date", $Delivery_date);
    $stmtBorrow->bindParam(":IDB", $bookID);
    $stmtBorrow->bindParam(":IDDEP", $bookDep);
    $stmtBorrow->bindParam(":borrower_ID", $userID);
    $stmtBorrow->execute();

    // Update the quantity of the borrowed book in the books table
    $queryUpdateQuantity = "UPDATE books SET quantity = quantity - 1 WHERE ID = :bookID;";
    $stmtUpdateQuantity = $pdo->prepare($queryUpdateQuantity);
    $stmtUpdateQuantity->bindParam(":bookID", $bookID);
    $stmtUpdateQuantity->execute();

    // Redirect to the main page
    header("Location: ../main_page.php");
    exit();
} else {
    // Redirect to the main page if the conditions are not met
    header("Location: ../main_page.php");
    exit();
}
