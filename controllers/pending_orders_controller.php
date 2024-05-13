<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../model/Delivery.php');

$delivery = new DeliveryModel();

$orders = $delivery->deliveryManPendingOrders($_COOKIE['user_id']);

$_SESSION['orders'] = $orders;

header('Location: ../views/pending_orders.php');
exit();
?>
