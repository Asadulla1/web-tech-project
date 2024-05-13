<?php
session_start();
require_once('../controllers/AuthenticationController.php');
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: ../views/login.php');
	exit();
}

$authController = new AuthenticationController();

$userinfo = $authController->fetchUserInfo($_SESSION['username']);

$_SESSION['userinfo'] = $userinfo;

header('Location: ../views/employee_dashboard.php');
exit();

?>
