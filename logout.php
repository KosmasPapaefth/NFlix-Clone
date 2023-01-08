<?php
// Initialize the session
session_start();

// Unset all of the session variables
unset($_SESSION['username']);
unset($_SESSION['role']);

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
