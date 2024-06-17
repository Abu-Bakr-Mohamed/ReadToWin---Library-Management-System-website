<?php
session_start();
require_once("./dbh.inc.php");

// Check if the user enters with a session and not by typing the URL
if (!empty($_SESSION['authenticated']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $bookName = $_POST["bookName"];
    $authorName = $_POST["authorName"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $departement = $_POST["departement"];
    $bookImage = $_FILES["bookImage"];

    // Directory where images are stored, create it if not exist
    $targetDir = __DIR__ . '/images/books';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Save the image on our server
    $targetFile = $targetDir . '/' . basename($bookImage["name"]);
    move_uploaded_file($bookImage["tmp_name"], $targetFile);
    $imagePath = "images/books/" . basename($bookImage["name"]);

    // Insert the book into the database
    $query = "INSERT INTO books (Name, Author, Price, quantity, IDdepartement, image_path) VALUES (:bookName, :authorName, :price, :quantity, :departement, :imagePath)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':bookName', $bookName);
    $stmt->bindParam(':authorName', $authorName);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':departement', $departement);
    $stmt->bindParam(':imagePath', $imagePath);

    // Execute the query and handle errors
    if ($stmt->execute()) {
        header("Location: ../staff_dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

} else {
    // If the user submitted the data using any other way, send them back to the landing page
    header("Location: ../staff_dashboard.php");
    exit();
}
