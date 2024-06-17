<?php
session_start();
require_once("./dbh.inc.php");

// Check if the request method is POST and the user is authenticated
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['authenticated'])) {
    // Get data from the form
    $bookID = $_POST["bookID"];
    $newPrice = $_POST["newPrice"];
    $newQuantity = $_POST["newQuantity"];

    // Check if either newPrice or newQuantity is provided
    if (!empty($newPrice) || !empty($newQuantity)) {
        $updateClauses = array();

        if (!empty($newPrice)) {
            $updateClauses[] = "Price = :newPrice";
        }

        if (!empty($newQuantity)) {
            $updateClauses[] = "quantity = :newQuantity";
        }

        // Build the dynamic update query
        $updateQuery = "UPDATE books SET " . implode(", ", $updateClauses) . " WHERE ID = :bookID;";
        $stmtUpdate = $pdo->prepare($updateQuery);

        // Bind parameters
        if (!empty($newPrice)) {
            $stmtUpdate->bindParam(':newPrice', $newPrice);
        }
        if (!empty($newQuantity)) {
            $stmtUpdate->bindParam(':newQuantity', $newQuantity);
        }

        $stmtUpdate->bindParam(':bookID', $bookID);
        $stmtUpdate->execute();

        // Redirect back to the staff dashboard after finishing
        header("Location: ../staff_dashboard.php");
        exit();
    } else {
        // Redirect back to the staff dashboard if neither newPrice nor newQuantity is provided
        header("Location: ../staff_dashboard.php");
        exit();
    }
} else {
    // Redirect back to the staff dashboard if the request method is not POST or the user is not authenticated
    header("Location: ../staff_dashboard.php");
    exit();
}
