<?php
// Include AuthenticationController
require_once('../controllers/AuthenticationController.php');

// Create an instance of AuthenticationController
$authController = new AuthenticationController();

// Call the logout function
$authController->logout();
?>
