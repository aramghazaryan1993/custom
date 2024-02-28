<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // Redirect logged-in users to another page (e.g., dashboard.php)
    header("Location: dashboard.php");
    exit();
}
?>