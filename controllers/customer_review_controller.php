<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../model/CustomerReview.php');

$customer = new CustomerReviewModel();

$userId = $_COOKIE['user_id'];

$_SESSION['reviews'] = $customer->getAllReviewsById($userId);

$_SESSION['avg'] = $customer->getAverage($userId);

header('Location: ../views/customer_review.php');
exit();
?>
