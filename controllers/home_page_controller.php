<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/CustomerController.php');
$customer = new CustomerController();

$products = $customer->getAllAvailableProducts();

$_SESSION['products'] = $products;

header('Location: ../views/home_page.php');
exit();

?>
