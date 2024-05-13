<?php
session_start();
require_once('../controllers/CustomerController.php');
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: ../views/login.php');
	exit();
}
$customer = new CustomerController();

$orders = $customer->findAllOrders($_SESSION['username']);

$_SESSION['orders'] = $orders;

header('Location: ../views/view_previous_orders.php');
exit();

?>
