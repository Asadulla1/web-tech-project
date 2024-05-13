<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../model/Delivery.php');

$deliv = new DeliveryModel();

$_SESSION['delivNum'] = $deliv->totalDelivery($_COOKIE['user_id']);

header('Location: ../views/updated_payroll.php');
exit();
?>
