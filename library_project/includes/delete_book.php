<?php
session_start();
require_once("./dbh.inc.php");

// Check if the request is a GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Get the book ID from the GET parameters
    $bookID = $_GET["bookID"];

    // Delete borrowing records associated with the book
    $queryDeleteBookBorrowing = "DELETE FROM borrowing WHERE borrowing.IDB = :bookID;";
    $stmtDeleteBookBorrowing = $pdo->prepare($queryDeleteBookBorrowing);
    $stmtDeleteBookBorrowing->bindParam(":bookID", $bookID);
    $stmtDeleteBookBorrowing->execute();

    // Delete the book from the books table
    $queryDeleteBook = "DELETE FROM books WHERE books.ID = :bookID;";
    $stmtDeleteBook = $pdo->prepare($queryDeleteBook);
    $stmtDeleteBook->bindParam(":bookID", $bookID);
    $stmtDeleteBook->execute();

    // Redirect back to the staff main page after deleting the book
    header("Location: ../main_page_staff.php");
    exit();

} else {
    // Redirect to the staff main page if the conditions are not met
    header("Location: ../main_page_staff.php");
    exit();
}

