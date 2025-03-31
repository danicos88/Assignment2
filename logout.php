<!--
Assignment 2
CST8285_332
logout.php
Completed By: Danielle Cossette
A file to logout a user 
Created: March 22, 2025
-->
<?php
session_start(); // Start the session
// Destroy all session variables
session_unset(); 
// Destroy the session itself
session_destroy(); 
// Redirect the user to the login page or homepage
header("Location: login_form.php");
exit(); // Ensure no further code is executed after the redirect
?>