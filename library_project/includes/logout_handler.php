<?php
session_start();

// Check if the form was submitted correctly
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_SESSION['authenticated'])) {
    // Regenerate the session ID to enhance security
    session_regenerate_id(true);

    // Clear and destroy the session
    session_unset();
    session_destroy();

    // Redirect to the index page after logout
    header("Location: ../index.php");
    exit();
} else {
    // Redirect to the index page if the user submitted the data using any other way
    header("Location: ../index.php");
    exit();
}
?>