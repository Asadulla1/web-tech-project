<?php
require_once('./AuthenticationController.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
    $password = $_POST['password'];
     
    $authController = new AuthenticationController();
    $authController->login($username, $password);
}

?>
