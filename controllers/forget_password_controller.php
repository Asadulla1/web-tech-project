<?php
require_once('./AuthenticationController.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $email = $_POST['email'];

	$authController = new AuthenticationController();

	$authController->emailExists($email);
}

?>
