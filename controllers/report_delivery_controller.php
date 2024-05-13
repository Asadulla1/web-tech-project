<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('location: ../views/login.php');
	exit();
}

require_once('../model/Delivery.php');
$delivery = new DeliveryModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$delivery_id = $_POST['delivery_id'];
	$status = $_POST['status'];
	$delivery->changeStatus($delivery_id, $status);
}


$delivs = $delivery->findAllReportingByUserId($_COOKIE['user_id']);

$_SESSION['delivs'] = $delivs;

header('Location: ../views/report_delivery.php');
exit();
?>
