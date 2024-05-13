<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: ../views/login.php');
	exit();
}

$customer = new CustomerController();

$loyaltyInfo = $customer->findLoyaltyInfo($_SESSION['user_id']);

$_SESSION['loyaltyInfo'] = $loyaltyInfo;

header('Location: ../views/view_loyalty.php');
exit();

?>
