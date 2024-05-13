<?php
session_start();
if (!isset($_COOKIE['username'])) {
	header('Location: login.php');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once('../model/User.php');
	$userModel = new UserModel();

	$user_id = $_SESSION['user_id'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];


	$userModel->updateUserInfo($user_id, $password, $email, $name, $phone_number, $address);

	header('Location: ' . $_SERVER['PHP_SELF']);
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$_SESSION['userinfo'] = $authController->fetchUserInfo($_SESSION['username']);


include '../views/update_user.php';
?>
