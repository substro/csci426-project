<?php
include "config/config.php";
// On the sign-out page or wherever the "sign out" action occurs
session_start(); // Start the session (if not already started)
session_destroy(); // Destroy the session

// Redirect to the main page or login page
header("Location: index.php"); 
exit();
?>
