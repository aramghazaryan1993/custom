<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect non-logged-in users to the login page
    header("Location: login.php");
    exit();
}

?>