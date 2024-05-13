<?php
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$reviews = [];

// Assuming you have a method in AdminController to fetch reviews
$result = $adminController->fetchAllReviews();

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

$_SESSION['reviews'] = $reviews;

header('Location: ../views/review_admin.php');
exit();

?>
