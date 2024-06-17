<?php
session_start();
require_once("./dbh.inc.php");

// Check if the form was submitted correctly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Grap the data and sanitize it
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    // Check if any of the data isn't provided
    if (empty($email) || empty($pwd)) {
        // Redirect back to index.php if any field is empty
        header("Location: ../index.php");
        exit();
    }

    // Check if the email and password
    $queryUser = "SELECT Email, ID, password FROM accounts WHERE Email = :email;";
    $stmt = $pdo->prepare($queryUser);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: ../index.php?errorType=You don't exist bro!");
        exit();
    }

    if (!password_verify($pwd, $user['password'])) {
        // Redirect to the landing page if the email doesn't exist or the password is incorrect
        header("Location: ../index.php?errorType=Incorrect password!");
        exit();
    } else {
        // Email exists, add this data to a session variable
        $_SESSION["email"] = $email;
        $_SESSION['authenticated'] = true;
        $userID = $user["ID"];
        $_SESSION["userID"] = $userID;
        $_SESSION["pwd"] = $pwd;

        // If it's a customer, go to the main page of customers
        $queryCust = "SELECT IDC FROM customers WHERE customers.IDC = :userID";
        $stmtCust = $pdo->prepare($queryCust);
        $stmtCust->bindParam(':userID', $userID);
        $stmtCust->execute();
        $customer = $stmtCust->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            header("Location: ../main_page.php");
            exit();
        }

        // If it's a staff, go to the dashboard of staff (main_page_staff)
        $queryStaff = "SELECT IDSt FROM staff WHERE staff.IDSt = :userID";
        $stmtStaff = $pdo->prepare($queryStaff);
        $stmtStaff->bindParam(':userID', $userID);
        $stmtStaff->execute();
        $staff = $stmtStaff->fetch(PDO::FETCH_ASSOC);

        if ($staff) {
            header("Location: ../staff_dashboard.php");
            exit();
        }
    }
} else {
    // If the user submitted the data using any other way, send them back to the landing page
    header("Location: ../index.php");
    exit();
}
