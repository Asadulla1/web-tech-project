<?php
require_once('./AuthenticationController.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $newPassword = $_POST['new_password'];
    $username = $_SESSION['username'];

	$authController = new AuthenticationController();

	$authController->changePassword($username, $newPassword);
    // Verify token and update password in the database
    // Redirect to login page
} 
?>
