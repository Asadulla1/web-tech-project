<?php
include '../views/update_user.php';
include'../model/User.php';
// session_start();
if (!isset($_COOKIE['username'])) {
	header('Location: login.php');
	exit();
}
//select User
require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$_SESSION['userinfo'] = $authController->fetchUserInfo($_SESSION['username']);
$userModel = new UserModel();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user_id = $_SESSION['user_id'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];


	$userModel->updateUserInfo($user_id, $password, $email, $name, $phone_number, $address);

	header('Location: ../views/login.php');
	exit();
}
?>
