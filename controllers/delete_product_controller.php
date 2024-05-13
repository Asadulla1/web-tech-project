<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$products = [];

$result = $adminController->fetchAllProducts();

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$_SESSION['products'] = $products;

header('Location: ../views/delete_product.php');
exit();

?>
