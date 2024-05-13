<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: ../views/login.php');
	exit();
}

$customer = new CustomerController();

$products = $customer->getAllAvailableProducts();

$_SESSION['products'] = $products;

header('Location: ../views/view_review.php');
exit();

?>
