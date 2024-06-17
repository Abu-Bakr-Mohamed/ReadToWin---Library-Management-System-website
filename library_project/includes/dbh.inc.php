<?php
$dsn = "mysql:host=localhost;dbname=library";
$dbusername = "root";
$dbpassword = "";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $dbusername, $dbpassword);

    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Display an error message if the connection fails
    echo "Connection Failed: " . $e->getMessage();
}
