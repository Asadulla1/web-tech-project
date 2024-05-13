<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: ../views/login.php');
	exit();
}

require_once('../controllers/AdminController.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$admin = new AdminController();
		
		$name = $_POST['name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$stock_quantity = $_POST['stock_quantity'];
		

		$admin->addProduct($name, $description, $price, $category, $stock_quantity);
		header('Location: ../controllers/view_products_controller.php');
		exit();
}

?>
