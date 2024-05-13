<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: ../views/login.php');
	exit();
}

$customer = new CustomerController();

$products = [];
$products = $customer->getAllAvailableProducts();
$products = $customer->findCartProducts($_SESSION['user_id']);

$_SESSION['products'] = $products;

header('Location: ../views/view_cart.php');
exit();

?>
