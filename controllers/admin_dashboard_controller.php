<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: http://localhost/greatbuy/views/login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$_SESSION['userinfo'] = $authController->fetchUserInfo($_SESSION['username']);

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$products = [];

$result = $adminController->fetchAllProducts();

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Location: ../views/admin_dashboard.php');

?>
