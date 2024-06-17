<?php
session_start();
require_once("./dbh.inc.php");

// Check if the form was submitted correctly
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['authenticated'])) {
    // Grab the data 
    $bookID = $_POST['bookID'];
    $enteredEmail = $_POST["email"];
    $enteredPwd = $_POST["pwd"];

    $email = $_SESSION["email"];
    $pwd = $_SESSION["pwd"];

    // Check if any of the data isn't provided
    if (empty($email) || empty($pwd)) {
        // Redirect back to the membership registration page if any field is empty
        header("Location: ../membership_reg.php");
        exit();
    }

    // Check if entered email and password doesn't match the session
    if ($enteredEmail != $email || $enteredPwd != $pwd) {
        header("Location: ../membership_reg.php?bookID=$bookID&errorType=Incorrect email or password!");
        exit();
    }

    // Add the membership
    $userID = $_SESSION["userID"];
    $currentDate = date("Y-m-d");
    $oneYearLater = date("Y-m-d", strtotime($currentDate . " +1 year"));
    $queryAddMembership = "UPDATE customers
    SET membership = 1, membership_expire_date = :oneYearLater
    WHERE IDC = :userID";

    $stmtAddMembership = $pdo->prepare($queryAddMembership);
    $stmtAddMembership->bindParam(':oneYearLater', $oneYearLater);
    $stmtAddMembership->bindParam(':userID', $userID);
    $stmtAddMembership->execute();

    // After adding the membership, redirect back to the borrow page
    header("Location: ../borrow.php?bookID=$bookID");
    exit();

} else {
    // If the user submitted the data using any other way, send them back to the index page
    header("Location: ../index.php");
    exit();
}
