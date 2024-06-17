<?php
session_start();
require_once("./dbh.inc.php");
// Check if the form was submitted correctly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Grap the data, sanitize it, and hash the password
    $userName = $_POST["user-name"];
    $phone = $_POST["phone"];
    $location = $_POST["location"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwd = password_hash($pwd, PASSWORD_BCRYPT);

    // Check if any of the data isn't provided
    if (empty($userName) || empty($email) || empty($pwd)) {
        // Redirect back to index.php if any field is empty
        header("Location: ../index.php");
        exit();
    }

    // Query to check if the email exists
    $query = "SELECT Email FROM accounts WHERE Email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Check if any rows are returned )(email already exists)
    if ($stmt->rowCount() > 0) {
        // Redirect back to index.php if email already exists
        header("Location: ../index.php");
        exit();
    }

    // Add the user's data to the accounts table
    $queryAccounts = "INSERT INTO accounts (Email, password) VALUES (:email, :pwd);";
    $stmtAccounts = $pdo->prepare($queryAccounts);
    $stmtAccounts->bindParam(":email", $email);
    $stmtAccounts->bindParam(":pwd", $pwd);
    $stmtAccounts->execute();

    // Add the customer's data to the customers table
    $lastInsertedID = $pdo->lastInsertId();
    $queryCustomers = "INSERT INTO customers (name, Phone , location, IDC) VALUES (:name, :Phone,:location, :IDC);";
    $stmtCustomers = $pdo->prepare($queryCustomers);
    $stmtCustomers->bindParam(":name", $userName); // replace with actual values
    $stmtCustomers->bindParam(":Phone", $phone); // replace with actual values
    $stmtCustomers->bindParam(":location", $location); // replace with actual values
    $stmtCustomers->bindParam(":IDC", $lastInsertedID);
    $stmtCustomers->execute();


    // Account verfied, grap the userID and start a session
    $queryUserID = "SELECT ID FROM accounts WHERE Email = :email;";
    $stmt = $pdo->prepare($queryUserID);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["email"] = $email;
    $_SESSION['authenticated'] = true;
    $userID = $user["ID"];
    $_SESSION["userID"] = $userID;
    $_SESSION["pwd"] = $_POST["pwd"];

    // Redirect to main_page.php after successful insertion
    header("Location: ../main_page.php");
    exit();

} else {
    // If the user submitted the data using any other way, send him back to the landing page
    header("Location: ../index.php");
    exit();
}
