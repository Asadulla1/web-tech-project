<?php
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$products = [];

$result = $adminController->fetchOrdersForAdmin();

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$_SESSION['products'] = $products;

header('Location: ../views/view_orders.php');
exit();

?>
