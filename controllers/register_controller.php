<?php
require_once('./AuthenticationController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$username = $_POST['username'];
    $password = $_POST['password'];
	$role = $_POST['role'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
     
    $authController = new AuthenticationController();
    $authController->register($name, $username, $password, $role, $email, $phone_number, $address);
}

?>
